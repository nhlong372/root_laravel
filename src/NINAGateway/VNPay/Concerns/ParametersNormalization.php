<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\VNPay\Concerns;

trait ParametersNormalization
{
    protected function normalizeParameters(array $parameters): array
    {
        $normalizedParameters = [];

        foreach ($parameters as $parameter => $value) {
            $parameter = str_replace('_', '', $parameter);
            $normalizedParameters[$parameter] = $value;
        }

        return $normalizedParameters;
    }
}