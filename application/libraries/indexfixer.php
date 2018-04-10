<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class IndexFixer{
    	public function remap(){
    		$ci=&get_instance();
            $method=$ci->uri->rsegment(2);
            $parameters=array_slice($ci->uri->rsegment_array(), 2);
    		$reflection=new ReflectionObject($ci);

            if($reflection->hasMethod($method)){
                $reflection->getMethod($method)->invokeArgs($ci,$parameters);
            }else{
                array_splice( $parameters, 0, 0, $method );
                $reflection->getMethod("index")->invokeArgs($ci,$parameters);
            }
    	}
    }
?>