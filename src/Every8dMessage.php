<?php

namespace Recca0120\Every8d;

class Every8dMessage
{
    /**
     * The message subject.
     *
     * @var string
     */
    public $subject = null;

    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * Create a new message instance.
     *
     * @param string $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message subject.
     *
     * @param string $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set the message subject.
     *
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Create a new message instance.
     *
     * @param string $content
     *
     * @return static
     */
    public static function create($content)
    {
        return new static($content);
    }
}
