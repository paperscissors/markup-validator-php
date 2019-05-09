<?php

namespace Fungku\MarkupValidator;

use Fungku\MarkupValidator\Contracts\FeedValidatorInterface;

class W3CFeedValidator implements FeedValidatorInterface
{

    public $is_valid = false;
    public $results = [];
    /**
     * Validate the atom or rss feed.
     *
     * @param string $feed The url of the feed to validate.
     * @return bool
     */
    public function validate($feed, $with_results=false)
    {
        $validator = "http://validator.w3.org/feed/check.cgi?output=soap12&url={$feed}";
        $response = file_get_contents($validator);

        $xml = new \DOMDocument();
        $xml->loadXML($response);

        $validity = $xml->getElementsByTagName('validity');
        $this->is_valid = $validity->length && $validity->item(0)->nodeValue == 'true';
        $this->results = $xml;
        // return the object, then we can just check both the validity and results if not valid
        if ($with_results) {
          return $this;
        }

        return $this->is_valid;
    }
}
