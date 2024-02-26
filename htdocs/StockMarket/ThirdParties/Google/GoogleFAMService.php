<?php

namespace ThirdParties\Google;

use PragmaRX\Google2FA\Google2FA;

class GoogleFAMService{

    public function __construct(
      private $google2FA = new Google2FA()
    ){}

    /**
     * 產生google Auth Info
     *
     * @param string $company
     * @param string $hoder
     * @return array
     * @author ZhiYong
     */
    public function generateGoogle2FAInfo(string $company, string $hoder): array
    {
        $secret = $this->google2FA->generateSecretKey();
        // $qrCodeUrl = $this->google2FA->getQRCodeUrl($company, $hoder, $secret);
        $qrCodeUrl = $this->coverUrl($this->google2FA->getQRCodeUrl($company, $hoder, $secret));

        return [$secret, $qrCodeUrl];
    }

    /**
     * googleMFA驗證
     *
     * @param string $authCode
     * @param string $mfa
     * @return boolean
     * @author ZhiYong
     */
    public function isValiMfa(string $authCode, string $mfa)
    {
        return $this->google2FA->verifyKey($authCode, $mfa);
    }

    /**
     * 轉為url
     *
     * @param string $qrCodeUrl
     * @param integer $size
     * @return string
     * @author ZhiYong
     */
    public function coverUrl(string $qrCodeUrl, int $size = 200): string
    {
        return 'https://chart.googleapis.com/chart?'.'chs='.$size.'x'.$size.'&chld=M|0&cht=qr&chl='.$qrCodeUrl;
    }
}
