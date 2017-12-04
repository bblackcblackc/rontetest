<?php
/**
 * Data validator class
 *
 * Validates data by criterias
 */

class DataValidatorClass
{

    public static function validateData(array $data, array $rules) {

        $validatedData = [];

        foreach ($data as $row) {

            $currentRow = [];

            foreach ($row as $dKey => $dValue) {
                try {

                    // if exist rule for this key
                    if (isset($rules[$dKey])) {

                        // get rule parameters
                        $validator = $rules[$dKey];
                        $validatorName = $validator[0];
                        $validatorParams = $validator[1];

                        // check if validator exists
                        $validatorMethodName = 'action' . VALIDATOR_METHOD_PREFIX . ucwords($validatorName);
                        if (method_exists(__CLASS__, $validatorMethodName)) {

                            // validate
                            if (self::$validatorMethodName($dValue,$validatorParams)) {
                                // validation ok
                                $currentRow[$dKey] = $dValue;
                            } else {
                                // validation fails, skip this data row
                                continue 2;
                            }

                        } else {
                            throw new RSExceptionClass('No such validator - ' . $validatorName);
                        }
                    }
                } catch (RSExceptionClass $e) {
                    RSExceptionClass::log($e->getMessage());
                    exit(1);
                }
            }

            // copy validated data to main
            $validatedData[] = $currentRow;
        }

        return $validatedData;
    }

    /**
     * @param string $data Data for validation
     * @param $param Validation parameters
     * @return bool
     * @method String validator
     */
    public static function actionValidateString(string $data, $param) {

        $required = isset($param[VALIDATOR_REQUIRED_ATTR]) ? $param[VALIDATOR_REQUIRED_ATTR] : false;

        mb_internal_encoding('utf8');

        // if string is required
        if ($required) {
            return (mb_check_encoding($data) && (mb_strlen($data) > 0));
        } else {
            return mb_check_encoding($data);
        }
    }

    /**
     * @param string $data Data for validation
     * @param $param Validation parameters
     * @return bool
     * @method URL validator
     */
    public static function actionValidateUrl(string $data, $param) {

        $required = isset($param[VALIDATOR_REQUIRED_ATTR]) ? $param[VALIDATOR_REQUIRED_ATTR] : false;

        $regex = '~^((https?)://)?'; // SCHEME
        $regex .= '([a-z0-9+!*(),;?&=$_.-]+(:[a-z0-9+!*(),;?&=$_.-]+)?@)?'; // User and Pass
        $regex .= '([a-z0-9\-\.]*)\.(([a-z]{2,4})|([0-9]{1,3}\.([0-9]{1,3})\.([0-9]{1,3})))'; // Host or IP
        $regex .= '(:[0-9]{2,5})?'; // Port
        $regex .= '(/([a-z0-9+$_%-]\.?)+)*/?'; // Path
        $regex .= '(\?[a-z+&\$_.-][a-z0-9;:@&%=+/$_.-]*)?'; // GET Query
        $regex .= '(#[a-z_.-][a-z0-9+$%_.-]*)?$~i'; // Anchor
        $matches = preg_match($regex, $data);

        if ($required) {
            // if url is required
            return ((bool)$matches && (strlen($data) > 0));
        } else {
            return (bool)$matches || (strlen($data) == 0);
        }
    }

    /**
     * @param int $data Data for validation
     * @param $param Validation parameters
     * @return bool
     * @method INT validator
     */
    public static function actionValidateInt(int $data, $param) {

        $required = isset($param[VALIDATOR_REQUIRED_ATTR]) ? $param[VALIDATOR_REQUIRED_ATTR] : false;
        $range = isset($param['range']) ? $param['range'] : false;

        if ($range) {
            // check range
            if (((int)$data < $param['range']['min']) or ((int)$data > $param['range']['max'])) {
                return false;
            }
        }

        if ((empty($data)) && $required) {
            return false;
        }

        if ($required) {
            return is_integer($data);
        }

        return true;
    }
}