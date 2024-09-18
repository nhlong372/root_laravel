<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Momo\Message;

class PayRefundResponse extends AbstractResponse
{
    public function getCode(): ?string
    {
        return $this->data['status'] ?? null;
    }
    public function getTransactionId(): ?string
    {
        return $this->data['partnerRefId'] ?? null;
    }
    public function getTransactionReference(): ?string
    {
        return $this->data['transid'] ?? null;
    }
}
