<?php

namespace Api\Controller;

use Api\Controller\AbstractController;
use Api\Response\EmptyResponse;
use Api\Response\JsonResponse;
use Api\Model\AddressModel;
use Api\Response\HttpStatusCodesEnum;

class AddressController extends AbstractController
{
    /**
     * @param int $id
     * @return EmptyResponse|JsonResponse
     */
    public function getByIdAction($id)
    {
        $address = (new AddressModel())->getById($id);

        if (empty($address)) {
            $response = new EmptyResponse();
            $response->setStatus(HttpStatusCodesEnum::HTTP_STATUS_NOT_FOUND);

            return $response;
        }

        $response = new JsonResponse();
        $response->setArrayData($address);

        return $response;
    }

    /**
     * @param int $id
     * @return EmptyResponse
     */
    public function updateByIdAction($id)
    {
        $requestParams = json_decode($this->getRequest()->getRawData(), true);

        if (JSON_ERROR_NONE != json_last_error()) {
            $response = new EmptyResponse();
            $response->setStatus(HttpStatusCodesEnum::HTTP_STATUS_BAD_REQUEST);

            return $response;
        }

        $addressModel = new AddressModel();

        $address = $addressModel->getById($id);

        if (empty($address)) {
            $response = new EmptyResponse();
            $response->setStatus(HttpStatusCodesEnum::HTTP_STATUS_NOT_FOUND);

            return $response;
        }

        $availableParams = ['LABEL', 'STREET', 'HOUSENUMBER', 'POSTALCODE', 'CITY', 'COUNTRY'];

        $params = array_intersect_key($requestParams, array_flip($availableParams));

        $addressModel->updateById((int)$id, $params);

        $response = new EmptyResponse();

        return $response;
    }

    /**
     * @return EmptyResponse|JsonResponse
     */
    public function listAction()
    {
        $availableParams = ['fields'];

        $params = array_intersect_key($this->getRequest()->getGet(), array_flip($availableParams));

        $list = (new AddressModel())->getList($params);

        if (empty($list)) {
            $response = new EmptyResponse();
            $response->setStatus(HttpStatusCodesEnum::HTTP_STATUS_NOT_FOUND);

            return $response;
        }

        $response = new JsonResponse();
        $response->setArrayData($list);

        return $response;
    }
}