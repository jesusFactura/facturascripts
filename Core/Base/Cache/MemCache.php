<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FacturaScripts\Core\Base\Cache;

/**
 * Description of ApcCache
 *
 * @author Jesus
 */
class MemCache implements CacheInterface{
    
    public function get($key){
        
        var_dump(memcache_get($key));
        
    }
            
            
    public function set($key, $content){
        
        memcache_set($key, $content);
        
    }
    
    
    
    public function delete($key){
        
        memcache_delete($key);
    }
    
    
    
    public function clear(){
        
        memcache_flush();
        
    }
    
}
