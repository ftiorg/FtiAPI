<?php
/**
 * Author: kamino
 * CreateTime: 2019/4/14,下午 01:41
 * Description:
 * Version:
 */


$apt = '/^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/';
preg_match( $apt, 'http://cloud.aikamino.cn', $matches );
print_r( $matches );