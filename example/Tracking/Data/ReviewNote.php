<?php
/**
 * Class Tracking_Data_ReviewNote
 */
class Tracking_Data_ReviewNote
{
    /**
     * @param Tracking_Data $data
     * @param string $version
     * @return string
     */
    public function generate(Tracking_Data $data, $version = 'confirm')
    {
        $version = '_' . $version;
        return $this->$version($data);
    }

    /**
     * @param Tracking_Data $data
     * @return string
     */
    protected function _confirm(Tracking_Data $data)
    {
        $reviewNote = '';
        $reviewNote .= str_replace(' ', '_', $data->getHotelName());
        return  $reviewNote;
    }

    /**
     * @param Tracking_Data $data
     * @return string
     */
    protected function _stepTwo(Tracking_Data $data)
    {
        return str_replace(' ', '_', $data->getHotelName()) . '_' . date('%Y.%m.%d', $data->getEndDate());
    }
}