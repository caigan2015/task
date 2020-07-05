<?php

namespace app\lib\enum;


class OrderStatusEnum
{
    // 已关闭
    const CLOSED = -1;
    // 待支付
    const UNPAID = 0;
    // 已支付
    const PAID = 1;
    // 已超时
    const OVERTIME = 2;
    // 退款中
    const REFUNDING = 3;
    // 已退款
    const REFUNDED = 4;
    // 已取消
    const CANCELED = 5;
}