<?php
namespace Ipsinternationnal\MoneyTigo\Plugin;

class CsrfValidatorSkip
{
    /**
     * @param \Magento\Framework\App\Request\CsrfValidator $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\App\ActionInterface $action
     */
    public function aroundValidate(
        $subject,
        \Closure $proceed,
        $request,
        $action
    ) {
        /* Magento 2.1.x, 2.2.x */
        if ($request->getModuleName() == 'moneytigo' || $request->getModuleName() == 'moneytigopnf') {
            return; // Skip CSRF check
        }
        /* Magento 2.3.x */
        if (strpos($request->getOriginalPathInfo(), 'moneytigo') !== false || strpos($request->getOriginalPathInfo(), 'moneytigopnf') !== false) {
            return; // Skip CSRF check
        }
        $proceed($request, $action);
    }
}