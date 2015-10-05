<?php

namespace Api\Controller;

use Api\Controller\AbstractController;
use Api\Response\EmptyResponse;
use Api\Response\JsonResponse;
use Api\Model\AddressModel;

class AddressController extends AbstractController
{
    public function getByIdAction($id)
    {
        $address = (new AddressModel())->getById($id);

        if (empty($address)) {
            $response = new EmptyResponse();
            $response->setStatus(404);
            return $response;
        }

        $response = new JsonResponse();
        $response->setArrayData($address);

        return $response;
    }

    public function updateByIdAction($id)
    {
        $data = [
            'code' => 200
        ];

        $response = new JsonResponse();
        $response->setArrayData($data);

        return $response;
    }

    /**
     * Get a list of addresses
     *
     * @return JsonResponse
     */
    public function listAction()
    {
        $availableParams = ['fields'];

        $params = array_intersect_key($this->getRequest()->getGet(), array_flip($availableParams));

        $response = new JsonResponse();
        $response->setArrayData((new AddressModel())->getList($params));

        return $response;
    }

    public function createAction()
    {
        // create new address
    }

    public function updateAction()
    {
        // update addresses
    }

    public function deleteAction()
    {
        // delete addresses
    }
}