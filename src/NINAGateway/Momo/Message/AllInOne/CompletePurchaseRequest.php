<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Momo\Message\AllInOne;
use Symfony\Component\HttpFoundation\ParameterBag;
class CompletePurchaseRequest extends AbstractIncomingRequest
{
    protected function getIncomingParametersBag(): ParameterBag
    {
        return $this->httpRequest->query;
    }
}