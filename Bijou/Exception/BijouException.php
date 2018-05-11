<?php
/**
 * Created by PhpStorm.
 * User: zhangzy
 * Date: 2017/3/17
 * Time: 09:11
 */

namespace Bijou\Exception;


use Bijou\Http\Request;
use Bijou\Http\Response;

abstract class BijouException extends \Exception
{
    private $request;
    private $response;

    /**
     * BijouException constructor.
     * @param string $message
     * @param int $code
     * @param Request $request
     * @param Response $response
     */
    public function __construct($message, $code, Request $request, Response $response)
    {
        parent::__construct($message, $code);
        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest() {
        return $this->request;
    }

    public function getResponse() {
        return $this->response;
    }

    /**
     * @param \Throwable $throwable
     */
    public function throwException(\Throwable $throwable)
    {
        $this->getResponse()->setStatus($this->code);
        $this->getResponse()->send([
            'code' => $this->code,
            'message' => $this->message
        ]);
    }

}