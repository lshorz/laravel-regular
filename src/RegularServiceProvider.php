<?php

namespace Lshorz\Regular;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class RegularServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //验证中文
        $this->app['validator']->extend('cn', function($attribute, $value, $parameters, $validator){
            return Regular::cn($value, isset($parameters[0]) ? intval($parameters[0]) : 0, isset($parameters[1]) ? strtolower($parameters[1]) : 'utf-8');
        });

        //验证姓名包括（中文、英文、空格）
        $this->app['validator']->extend('name', function($attribute, $value, $parameters, $validator){
            return Regular::name($value, isset($parameters[0]) ? intval($parameters[0]) : 0);
        });

        //中文、英文、数字、上下划线、空格括号组合
        $this->app['validator']->extend('comb', function($attribute, $value, $parameters, $validator){
            return Regular::comb($value);
        });

        //浮点数
        $this->app['validator']->extend('float', function($attribute, $value, $parameters, $validator){
            return Regular::float($value);
        });

        //日期时间验证2010-02-26 11:05:05
        $this->app['validator']->extend('date_time', function($attribute, $value, $parameters, $validator){
            return Regular::dateTime($value);
        });

        //时间
        $this->app['validator']->extend('time', function($attribute, $value, $parameters, $validator){
            return Regular::time($value, $parameters[0]);
        });

        //联系电话(包括手机及固话)
        $this->app['validator']->extend('phone', function($attribute, $value, $parameters, $validator){
            return Regular::phone($value);
        });

        //手机号码
        $this->app['validator']->extend('mobile', function($attribute, $value, $parameters, $validator){
            return Regular::mobile($value);
        });

        //固定电话号码
        $this->app['validator']->extend('tel', function($attribute, $value, $parameters, $validator){
            return Regular::tel($value);
        });

        //邮政编码
        $this->app['validator']->extend('zip', function($attribute, $value, $parameters, $validator){
            return Regular::zip($value);
        });

        //身份证(含港澳)
        $this->app['validator']->extend('id_card', function($attribute, $value, $parameters, $validator){
            return Regular::idCard($value);
        });

        //身份证(香港)
        $this->app['validator']->extend('id_card_hk', function($attribute, $value, $parameters, $validator){
            return Regular::idCardHk($value);
        });

        //身份证(澳门)
        $this->app['validator']->extend('id_card_mo', function($attribute, $value, $parameters, $validator){
            return Regular::idCardMo($value);
        });

        //身份证(台湾)
        $this->app['validator']->extend('id_card_tw', function($attribute, $value, $parameters, $validator){
            return Regular::idCardTw($value);
        });

        //身份证(仅大陆)
        $this->app['validator']->extend('id_card_chinese', function($attribute, $value, $parameters, $validator){
            return Regular::idCardChinese($value);
        });

        //社会信用代码
        $this->app['validator']->extend('credit_code', function ($attribute, $value, $parameters, $validator) {
            return Regular::creditCode($value);
        });

        //车牌号
        $this->app['validator']->extend('car_plate', function ($attribute, $value, $parameters, $validator) {
            return Regular::carPlate($value);
        });

        //微信号
        $this->app['validator']->extend('wechat_id', function ($attribute, $value, $parameters, $validator) {
            return Regular::wechatId($value);
        });

        //金额
        $this->app['validator']->extend('money', function($attribute, $value, $parameters, $validator){
            return Regular::money($value);
        });

        //当前时间前
        $this->app['validator']->extend('date_before_now', function($attribute, $value, $parameters, $validator){
            Carbon::setLocale('zh');
            $date_time = Carbon::parse($value);
            return $date_time->lte(Carbon::now());
        });

        //当前时间后
        $this->app['validator']->extend('date_after_now', function($attribute, $value, $parameters, $validator){
            Carbon::setLocale('zh');
            $date_time = Carbon::parse($value);
            return $date_time->gt(Carbon::now());
        });

        //验证的日期在给定时间之前(2018-11-03 00:00:00)
        $this->app['validator']->extend('date_before', function($attribute, $value, $parameters, $validator){
            Carbon::setLocale('zh');
            $date_time = Carbon::parse($value);
            return $date_time->lte(Carbon::parse($parameters[0]));
        });

        //验证的日期在给定时间之后(2018-11-03 00:00:00)
        $this->app['validator']->extend('date_after', function($attribute, $value, $parameters, $validator){
            Carbon::setLocale('zh');
            $date_time = Carbon::parse($value);
            return $date_time->gt(Carbon::parse($parameters[0]));
        });

        //验证的日期在两者时间之中
        $this->app['validator']->extend('date_between', function($attribute, $value, $parameters, $validator){
            Carbon::setLocale('zh');
            $date_time = Carbon::parse($value);
            $start = Carbon::parse($parameters[0]);
            $end = Carbon::parse($parameters[1]);
            return $date_time->between($start, $end);
        });

        //验证密码强度
        $this->app['validator']->extend('password_strength', function($attribute, $value, $parameters, $validator){
            return Regular::passwordStrength($value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
