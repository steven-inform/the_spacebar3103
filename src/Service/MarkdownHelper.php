<?php
namespace App\Service;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $markdown;
    private $cache;
    private $logger;

    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache,
                                                    LoggerInterface $markdownLogger, bool $isDebug)
    {
        //print "!! MARKDOWNHELPER CONSTRUCTOR !!";

        $this->markdown = $markdown;
        $this->cache = $cache;
        $this->logger = $markdownLogger;
    }

    public function parse($articleContent)
    {
        $this->logger->info("I am logging!!!");

        //set key for cache-item
        $item = $this->cache->getItem('markdown_' . md5($articleContent));

        if ( ! $item->isHit()) //if item does not exist in cache
        {
            $item->set($this->markdown->transform($articleContent)); //set value
            $this->cache->save($item); //store in cache
        }

        return $item->get(); //get value from cache
    }

}