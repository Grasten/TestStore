<?php


namespace Framework;


class JsonResult implements ResultInterface
{
    private $data = [];

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function send(): void
    {
        header('Content-type: application/json');
        echo json_encode($this->data);
    }
}
