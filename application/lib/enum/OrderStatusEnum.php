<?php

namespace app\lib\enum;


class OrderStatusEnum
{
    // 無効
    const CLOSED = -1;
    // 両方確認待ち
    const WAIT_CONFIRM = 0;
    // 両方確認済み、待支付
    const WAIT_PAID = 1;
    // 運営方お金を確認
    const CONFIRM_PAID = 2;
    // タスク済みの確認
    const TASK_DONE = 3;
    // 全額支払い済み確認
    const PAID_DONE = 4;
    // キャンセル
    const CANCELED = 5;
}