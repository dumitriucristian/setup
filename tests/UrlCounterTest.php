<?php
use Threecolts\Phptest\UrlCounter;
use PHPUnit\Framework\TestCase;

class UrlCounterTest extends TestCase
{
    public function test_count_unique_url_return_number_of_urls()
    {
        
        $counter = new UrlCounter;
        $data = ["https://example.com"];

        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(1, $result);
        
    }

    public function test_last_slash_is_removed()
    {
        $counter = new UrlCounter;
        $data = ["https://example.com","https://example.com/"];
        
        
        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(1, $result);
        
    }

    public function test_https_and_http_are_not_removed()
    {
        $counter = new UrlCounter;
        $data = ["https://example.com","http://example.com/"];
        
        
        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(2, $result);
        
    }


    public function test_similar_https_with_same_get_params_are_removed()
    {
        $counter = new UrlCounter;
        $data = ["https://example.com?","https://example.com"];
        
        
        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(1, $result);
        
    }


    public function test_same_params_with_different_order_are_removed(){

        $counter = new UrlCounter;
        $data = ["https://example.com?a=1&b=2", "https://example.com?b=2&a=1"];
        
        
        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(1, $result);

    }


    public function test_count_different_urls_with_different_base()
    {
        $counter = new UrlCounter;
        $data = [
        "https://example.com?a=1&b=2", 
        "https://example.com?b=2&a=1",
        "https://books.com?b=2&a=1"
        ];
        
        
        $result = $counter->countUniqueUrls($data);
        
        $this->assertEquals(2, $result);
    }
}
