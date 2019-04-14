<?php
/**
 * Author: kamino
 * CreateTime: 2019/4/14,下午 01:41
 * Description:
 * Version:
 */


require_once "vendor/autoload.php";

preg_match( '/url=(.*)/', 'http://localhost/?url=https://space.bilibili.com/ajax/Bangumi/getList?page=1&pagesize=100&mid=16011372', $matches );

print_r( $matches );