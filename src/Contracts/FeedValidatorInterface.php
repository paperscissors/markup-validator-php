<?php

namespace Fungku\MarkupValidator\Contracts;

interface FeedValidatorInterface
{
    /**
     * Validate an atom or rss feed.
     *
     * @param string $feed
     * @param bool $with_results
     * @return bool
     */
    public function validate($feed, $with_results);

}
