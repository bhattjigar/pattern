<?php 
 class allfunctions
{


    public function STARTING($haystack,$needle) 
     {
     	try
     	{
     		// search backwards starting from haystack length characters from the end
        	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;	
     	}
        catch(Exception $e)
        {
        	die($e->getMesage());
        }
     }



      public function ENDING($haystack,$needle) 
      {
          
          try
          {
          		// search forward starting from end minus needle length characters
          		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
          }
          catch(Exception $e)
          {
          	die($e->getMesage());
          }

      }

          public function CHECKNULL($str)
     {
     	try
     	{
     		if(trim($str)!=="")
	     	{
	     		return 1;
	     	}
	     	else
	     	{
	     		return 0;
	     	}
	
     	}
     	catch(Exception $e)
     	{
     		die($e->getMesage());
     	}
     	
     }
          public function ISWORD($string,$ch)
      {
      	try
      	{
      		if(substr($string,$ch)!== false)
	      	{
	      		return 1;
	      	}
	      	else
	      	{
	      		return 0;
	      	}
      	}
      	catch(Exception $e)
      	{
      		die($e->getMesage());
      	}
      	
      }

      
// get domain name
          public function DOMAIN($domainurl,$flag=0)
      {
      	try
      	{
      			$urltype=substr($domainurl,0,5);

		      	if($urltype=="https")
		      		{
		        		$urltype=substr($domainurl,0,6);
		      		}
		      	$pieces = parse_url($domainurl);
		        $domain = isset($pieces['host']) ? $pieces['host'] : '';
		        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
			         {
			        	$finalurl=$urltype."//www.".$regs['domain'];
			          	$domain=$regs['domain'];
			         }
               if($flag==1)
               {
                  return $finalurl;
               }
               else
			         return $domain;
      	}
      	catch(Exception $e)
      	{

      	}
      }

      ///validating url for [//] [/] [starts with www ] [verified with url http or https:]
     /*
     0.  .
     1. //
     2. /
     2.1  ./    
     3. http:
     4. https:
     5. www

     */
        public function VERIFYURL($url,$domainurl)
    {

    	try
    	{
	    		$urltype=substr($domainurl,0,5);

		      	if($urltype=="https")
		      		{
		        		$urltype=substr($domainurl,0,6);
		      		}
		      	$pieces = parse_url($domainurl);
		        $domain = isset($pieces['host']) ? $pieces['host'] : '';
		        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
			         {
			        	$finalurl=$urltype."//".$regs['domain'];
			          	$domain=$regs['domain'];
			         }
	    		
    		 	$oldurl=$url;

                $url=str_replace("\\","",$url);

                $url=str_replace('"',"",$url);
                
                
		        if($this->STARTING($url,"//")==1)
		        {
		            $url=$urltype.$url;
		            //echo "</br>//------>".$url."</br>";
		        }

		        else if($this->STARTING($url,"/")==1)
		        {
               
		            $url=$urltype."//www.".$domain.$url;
                
		            //echo "</br>/------>".$url."</br>";
		        }


		        else if($this->STARTING($url,"./")==1)
		        {
		        	
		            $url=str_replace("./","",$url);
		            $url=$urltype."//www.".$domain."/".$url;
		            //echo "</br>./------>".$url."</br>";
		        }


		        else if($this->STARTING($url,".")==1)
		        {
		             $url=$url;
		             //echo "</br>...------>".$url."</br>";
		        }

		        else if($this->STARTING($url,"www")==1)
		        {
		                echo $urltype."</br>"; 
		              $url=$urltype."//".$url;
		              //echo "</br>www------>".$url."</br>";

		        }
		        else if($this->STARTING($url,"#")==1)
		        {
		           $url=$finalurl;
		        }
		        
		 
		        else
		        {
              
		        }

              

		       

	            if($this->ENDING($url, '.jpg') ==1||$this->ENDING($url, '.png') ==1||$this->ENDING($url, '.js') ==1||$this->ENDING($url, '.css') ==1||$this->ENDING($url, 'javascript:void') ==1||$this->ENDING($url, '.gif') ==1||$this->ENDING($url, '.ico') ==1)
	              {
	                return '';
	              }
	            else
	            {
	            	if($this->CHECKNULL($url)==1&&$this->STARTING($url,"http")==1)
	            	{
	            		if (strpos($url, $this->DOMAIN($this->url)) !== false&&$this->DOMAIN($this->url)==$this->DOMAIN($url))
                 {
                    // echo $this->DOMAIN($url);
                    return $url;
                 }
                 else
                 {
                   return false;
                 }
	            	}
	            	else
	            	{
	            		$url=trim($url);
	            		if($url!="")
	            		{
	            			
	            		}
	            		
	            	}
	            	

	            }
	              

    	}
    	catch(Exception $e)
    	{
    		die($e->getMesage());
    	}

                
               

    }

        public function MAKEARRAY($array)
    {
    	try
    	{
    		$tmp=array();
            foreach ($array as $key => $value)
            	{
                 
                 array_push($tmp,$key);        

             	}
      
      		return $tmp;
    	}
        catch(Exception $e)
        {
        	die($e->getMesage());
        }   


    }

 

    public function BOT($url)
  {
    try
    {
      
      
          if (!function_exists('curl_init'))
          {
                  die('Timeswen is Busy....');
          }
          else
          {
            $ch = curl_init();

                  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
                  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
                  $header[] = "Cache-Control: max-age=0";
                  $header[] = "Connection: keep-alive";
                  $header[] = "Keep-Alive: 300";
                  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
                  $header[] = "Accept-Language: en-us,en;q=0.5";
                  $header[] = "Pragma: ";

                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
                  //curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Wenbot/1.0; +http://www.Timeswen.com/wenbot");
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                    
                    // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
                    //curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    $html=curl_exec($ch);

                    $report=curl_getinfo($ch);
                    // print_r($report);
                    curl_close($ch);
                      /*echo $url."</br>".$report['http_code']."</br>";*/
                      
                    // if($report['http_code']==404 || strpos($report['content_type'], 'text') === FALSE)
                    // {
                    //   die("not found");
                    // }
                     if($report['http_code']!=404)
                     {
                      return $html;
                     }
                    else
                    {
                      return 0;
                    }
          }
    }
    catch(Exception $e)
    {
      echo $e->getMesage();
    }
          
      
  }

      public function URLCOMPARE($url1, $url2) 
  {
    try
    {
        $domain1 = parse_url($url1,PHP_URL_HOST);
        $domain2 = parse_url($url2,PHP_URL_HOST);
        if(CHECKNULL($domain1)==1&&CHECKNULL($domain2)==1)
        {
          $domain1 = isset($domain1) ? str_ireplace('www.', '',$domain1) : str_ireplace('www.', '',$url1); 
          $domain2 = isset($domain2) ? str_ireplace('www.', '',$domain2) : str_ireplace('www.', '',$url2);
          if(strstr($domain2, $domain1))
          {
              return 1;
          }
          else
          {
              return 99;
          }
          
        }
      
    }
    catch(Exception $e)
    {

    }
      
}
    public function u($t)
{
  try
  {
    unset($t);
  }
  catch(Exception $e)
  {
     die("delete not perform ".$t);
  }
}
    public function deletefile($file)
{
  if(is_writable(dirname(__FILE__) .$file))
  {
      unlink(dirname(__FILE__) . $file); 
  }
}


    public function getsql($table)
{
  $sql=<<<EOSQL
  INSERT OR IGNORE INTO  $table (wen_name,wen_hash) VALUES
EOSQL;
    return $sql;
}
    public function htmlallentities($str)
{
  $res = '';
  $strlen = strlen($str);
  for($i=0; $i<$strlen; $i++){
    $byte = ord($str[$i]);
    if($byte < 128) // 1-byte char
      $res .= $str[$i];
    elseif($byte < 192); // invalid utf8
    elseif($byte < 224) // 2-byte char
      $res .= '&#'.((63&$byte)*64 + (63&ord($str[++$i]))).';';
    elseif($byte < 240) // 3-byte char
      $res .= '&#'.((15&$byte)*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
    elseif($byte < 248) // 4-byte char
      $res .= '&#'.((15&$byte)*262144 + (63&ord($str[++$i]))*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
  }
  return $res;
}
}
    ?>