<?php

namespace Recca0120\Every8d;

class Every8dMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The message type.
     *
     * @var string
     */
    public $type = 'text';

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
