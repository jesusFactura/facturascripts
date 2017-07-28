<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FacturaScripts\Core\Base\Cache;

/**
 *
 * @author Jesus
 */
interface CacheInterface {
    
    public function get($key);
    public function set($key, $content);
    public function delete($key);
    public function clear();
}
