<?php
namespace Home\Pay;
class Jdpay
{
    protected $v_amount; //金额
    protected $_moneytype; //货币类型
    protected $v_oid; //订单号
    protected $v_mid; // 商户号
    protected $v_url;
    protected $v_key; //秘钥

    public function __construct($v_oid,$v_amount)
    {
        $this->v_oid = $v_oid;
        $this->v_amount = $v_amount;
        $this->v_mid = C('V_MID');
        $this->v_url = C('V_URL');
        $this->v_key = C('V_KEY');
    }

    public function form(){
        $form= '<form method=post action="https://pay3.chinabank.com.cn/PayGate">
                <input type=hidden name=v_mid value="%s">
                <input type=hidden name=v_oid value="%s">
                <input type=hidden name=v_amount value="%s">
                <input type=hidden name=v_moneytype value="%s">
                <input type=hidden name=v_url value="%s">
                <input type=hidden name=v_md5info value="%s">
                <input type="submit" value="支付" />
                </form>
            ';
        sprintf($form,$this->v_mid,$this->v_oid,$this->v_amount,$this->v_url,$this->sign());
}

    /**
     * @return string 数字签名
     */
    public function sign(){
        $sign = $this->v_amount . $this->_moneytype . $this->v_oid . $this->v_mid . $this->v_url . $this->v_key;
        return strtoupper(md5($sign));
    }
}