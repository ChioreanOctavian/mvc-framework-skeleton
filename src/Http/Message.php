<?php


namespace Framework\Http;


use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    private $protocolVersion;
    private $headers;
    private $body;

    public function __construct(string $protocolVersion, array $headers, StreamInterface $body)
    {
        $this->protocolVersion = $protocolVersion;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {

        return $this->protocolVersion;
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        $message = clone $this;
        $message->protocolVersion = $version;

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {

        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        if (!isset($this->headers[$name] )) {
            return [];
        }

        return $this->headers[$name];;
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        //test if key name exists
        //
        return $name.":".implode(", ", $this->headers[$name]);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        //make value a array
        $message = clone $this;
//        if (is_array($value)) {
//            $message->headers[$name] = $value;
//            return $message;
//        }
        $message->headers[$name] = [$value];

        return $message;
    }

    /**
     * @inheritDoc
     */
    public
    function withAddedHeader($name, $value)
    {
        //TODO: FIX
        $message = clone $this;
        $message = array_merge($message->headers[$name], $value);

        return $message;
    }

    /**
     * @inheritDoc
     */
    public
    function withoutHeader($name)
    {
        $message = clone $this;
        unset($message->headers[$name]);
        return $message;
    }

    /**
     * @inheritDoc
     */
    public
    function getBody()
    {

        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public
    function withBody(StreamInterface $body)
    {
        $message = clone $this;
        $message->body = $body;

        return $message;
    }
}