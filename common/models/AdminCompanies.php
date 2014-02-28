<?php
/**
 * Created by PhpStorm.
 * User: Zimovid
 * Date: 27.02.14
 * Time: 15:59
 */

class AdminCompanies extends LegacyActiveRecord {

    /**
     * Name of the database table associated with this ActiveRecord
     *
     * @return string
     */
    public function tableName() {
        return 'admin_companies';
    }

}