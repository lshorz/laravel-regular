<?php

namespace Lshorz\Regular;

/**
 * 正则验证扩展
 */
class Regular
{
    /**
     * 中文
     *
     * @param string $str
     * @param int $len 直接中文字符的个数
     * @param string $charset (utf8\gbk\gb2312)
     * @return bool
     */
    public static function cn(string $str, int $len = 0, string $charset = 'utf8'): bool
    {
        $charset = strtolower($charset);
        if (is_int($len) && ($len > 0)) {
            if ($charset == 'utf8' || $charset == 'utf-8') {
                $len = $len * 3;
            } elseif ($charset == 'gbk' || $charset == 'gb2312') {
                $len = $len * 2;
            }
            return preg_match("/^[\x7f-\xff]{" . $len . "}$/", $str) ? true : false;
        } else {
            return preg_match("/^[\x7f-\xff]+$/", $str) ? true : false;
        }
    }

    /**
     * 验证姓名包括（中文、英文、空格）
     *
     * @param string $str
     * @param int $len 直接中文字符的个数
     * @return bool
     */
    public static function name(string $str, int $len = 0): bool
    {
        if ($len > 2) {
            return preg_match("/^[\x7f-\xffa-zA-Z\s]{2," . $len . "}$/", $str) ? true : false;
        } else {
            return preg_match("/^[\x7f-\xffa-zA-Z\s]{2,}$/", $str) ? true : false;
        }
    }

    /**
     * 中文、英文、数字、上下划线、空格或者四项组合
     *
     * @param string $str
     * @return bool
     */
    public static function comb(string $str): bool
    {
        return preg_match("/^[\x7f-\xffa-zA-Z0-9-_()（）\s]+$/", $str) ? true : false;
    }

    /**
     * 浮点数
     *
     * @param string $str
     * @return bool
     */
    public static function float(string $str): bool
    {
        return preg_match("/^[0-9]+\.[0-9]+$/", $str) ? true : false;
    }

    /**
     * 日期时间验证2010-02-26 11:05:05
     * @param string $str
     * @return bool
     */
    public static function dateTime(string $str): bool
    {
        $regx = "/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\
	s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s(((0?[0-9])|([1-2][0-9]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/";
        return preg_match($regx, $str) ? true : false;
    }

    /**
     *  时间格式验证
     *
     * @param string $str
     * @param int $type [1:24小时|2:12小时]
     *
     * @return bool
     */
    public static function time(string $str, int $type = 1): bool
    {
        if ($type == 2) {
            return preg_match("/^(?:1[0-2]|0?[1-9]):[0-5]\d:[0-5]\d$/", $str) ? true : false;
        } else {
            return preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/", $str) ? true : false;
        }
    }

    /**
     * 联系电话(包括手机及固话)
     *
     * @param string $str
     * @return bool
     */
    public static function phone(string $str): bool
    {
        return preg_match("/^(((13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9]|19[0-9])\d{8})|(\d{3,4}?-|\d{3,4})?(\d{7}))$/", $str) ? true : false;
    }

    /**
     * 固定电话号码
     *
     * @param string $str
     * @return bool
     */
    public static function tel(string $str): bool
    {
        return preg_match("/^(\d{3,4}?-|\d{3,4})?(\d{7,8})$/", $str) ? true : false;
    }

    /**
     * 手机号码(含港澳台)
     *
     * @param string $str
     * @return bool
     */
    public static function mobile(string $str): bool
    {
        //return preg_match("/^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9]|19[0-9])\d{8}$/", $str) ? true : false;
        return preg_match("/^[1][3-9]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/", $str) ? true : false;
    }

    /**
     * 电子邮箱
     *
     * @param string $str
     * @return bool
     */
    public static function email(string $str): bool
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i", $str) ? true : false;
    }

    /**
     * 邮政编码
     *
     * @param string $str
     * @return bool
     */
    public static function zip(string $str): bool
    {
        return preg_match("/^[1-9]\d{5}$/", $str) ? true : false;
    }

    /**
     * 验证身份证(含港澳台)
     *
     * @param string $str
     * @return bool
     */
    public static function idCard(string $str): bool
    {
        return preg_match("/^\d{15}$|^\d{18}$|^\d{17}[xX]|^[a-zA-Z]{1,2}\d{6}\([0-9a-zA-Z]{1}\)|^[1|5|7]\d{6}[(\d)]{3}|^[a-zA-Z][0-9]{9}$/", $str) ? true : false;
    }

    /**
     * 验证香港身份证
     *
     * @param string $str
     * @return bool
     */
    public static function idCardHk(string $str): bool
    {
        return preg_match("/^[a-zA-Z]\d{6}\([\dA]\)$/", $str) ? true : false;
    }

    /**
     * 验证澳门身份证
     *
     * @param string $str
     * @return bool
     */
    public static function idCardMo(string $str): bool
    {
        return preg_match("/^[1|5|7]\d{6}[(\d)]{3}$/", $str) ? true : false;
    }

    /**
     * 验证台湾身份证
     *
     * @param string $str
     * @return bool
     */
    public static function idCardTw(string $str): bool
    {
        return preg_match("/^[a-zA-Z][0-9]{9}$/", $str) ? true : false;
    }

    /**
     * 验证身份证(仅大陆)
     *
     * @param string $str
     * @return bool
     */
    public static function idCardChinese(string $str): bool
    {
        $id = strtoupper($str);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = [];
        if (!preg_match($regx, $id)) {
            return false;
        }
        //检查15位
        if (15 == strlen($id)) {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return false;
            } else {
                return true;
            }
        } else {           //检查18位
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            //检查生日日期是否正确
            if (!strtotime($dtm_birth)) {
                return false;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
                $arr_ch = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$id[$i];
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    /**
     * 验证社会统一信用号
     *
     * @param string $str
     * @return bool
     */
    public static function creditCode(string $str): bool
    {
        return preg_match("/^[^_IOZSVa-z\W]{2}\d{6}[^_IOZSVa-z\W]{10}$/", $str) ? true : false;
    }

    /**
     * 车牌号
     *
     * @param string $str
     * @return bool
     */
    public static function carPlate(string $str): bool
    {
        return preg_match("/^[京津沪渝冀豫云辽黑湘皖鲁新苏浙赣鄂桂甘晋蒙陕吉闽贵粤青藏川宁琼使领][A-HJ-NP-Z][A-HJ-NP-Z0-9]{4,5}[A-HJ-NP-Z0-9挂学警港澳]$/", $str) ? true : false;
    }

    /**
     * 微信号
     *
     * @param string $str
     * @return bool
     */
    public static function wechatId(string $str):bool
    {
        return preg_match("/^[a-zA-Z][-_a-zA-Z0-9]{5,19}$/", $str) ? true : false;
    }

    /**
     * 验证金额
     *
     * @param string $str
     * @return bool
     */
    public static function money(string $str): bool
    {
        return preg_match("/^(-)?(([1-9]{1}\d*)|([0]{1}))(\.(\d){1,2})?$/", $str) ? true : false;
    }

    /**
     * 验证密码强度
     * 最少6位，包括至少1个大写字母，1个小写字母，1个数字，1个特殊字符
     *
     * @param string $str
     * @return bool
     */
    public static function passwordStrength(string $str): bool
    {
        return preg_match("/^\S*(?=\S{6,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[!@#$%^&*? ])\S*$/", $str) ? true : false;
    }
}
