<?php
use Threecolts\Phptest\UrlCounter;
use PHPUnit\Framework\TestCase;

class UrlCounterTest extends TestCase
{
    public function test_count_unique_url_return_number_of_urls()
    {
        
       
        $data = ["https://example.com"];
        $counter = new UrlCounter($data);

        $result = $counter->countUniqueUrls();
        
        $this->assertEquals(1, $result);
        
    }

    public function test_last_slash_is_removed()
    {
        $data = ["https://example.com","https://example.com/"];
        $counter = new UrlCounter($data);
                
        $result = $counter->countUniqueUrls();
        
        $this->assertEquals(1, $result);
        
    }

    public function test_https_and_http_are_not_removed()
    {
        $data = ["https://example.com","http://example.com/"];
        $counter = new UrlCounter($data);
                       
        $result = $counter->countUniqueUrls();
        
        $this->assertEquals(2, $result);
        
    }


    public function test_similar_https_with_same_get_params_are_removed()
    {
        $data = ["https://example.com?","https://example.com"];
        $counter = new UrlCounter($data);
   
        $result = $counter->countUniqueUrls();

        $this->assertEquals(1, $result);
        
    }


    public function test_same_params_with_different_order_are_removed(){

        $data = ["https://example.com?a=1&b=2", "https://example.com?b=2&a=1"];
        $counter = new UrlCounter($data);
       
        $result = $counter->countUniqueUrls();
        
        $this->assertEquals(1, $result);

    }


    public function test_count_different_urls_with_different_base()
    {

        $data = [
            "https://example.com?a=1&b=2", 
            "https://example.com?b=2&a=1",
            "https://books.com?b=2&a=1"
            ];
            
        $counter = new UrlCounter($data);
        
        $result = $counter->countUniqueUrls();
        
        $this->assertEquals(2, $result);
    }


    public function test_we_can_have_distinct_urls()
    {
        $data = [
            "https://example.com?a=1&b=2", 
            "https://example.com?b=2&a=1",
            "https://books.com?b=2&a=1",
            "https://example.com?",
            "https://example.com/"
            ];
            
        $counter = new UrlCounter($data);
        
        $result = $counter->getDistinctUrls();
        $expected = [
            'https://example.com' => ['a=1&b=2','b=2&a=1'],
            'https://books.com' => ['b=2&a=1']
            

        ];
   
        $this->assertEquals(2, count($result));
        $this->assertEquals(json_encode($expected),json_encode($result));
    }
}
