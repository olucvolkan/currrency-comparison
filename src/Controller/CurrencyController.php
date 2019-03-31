<?php

namespace App\Controller;


use App\Repository\CurrencyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    /**
     * @Route("/", name="currency")
     * @Template()
     */
    public function index(CurrencyRepository $currencyRepository)
    {
        $cheapEuro = $currencyRepository->getEuroCurrency();
        $cheapUsd = $currencyRepository->getDolarCurrency();
        $cheapGbp = $currencyRepository->getGbpCurrency();
        return array(
            'cheapEuro' => $cheapEuro,
            'cheapUsd' => $cheapUsd,
            'cheapGbp' => $cheapGbp
        );
    }
}
