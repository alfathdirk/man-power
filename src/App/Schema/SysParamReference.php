<?php

namespace App\Schema;

// use \Norm\Schema\Field;
use \Norm\Schema\Reference;
use \Norm\Norm;

class SysParamReference extends Reference {

    public function by($group) {
        $this->foreignGroup = $group;

        $this->set('foreignGroup',$group);
        $this->set('foreign','Sysparam');
        $this->set('foreignLabel','value');
        $this->set('foreignKey','key');

        return $this;
    }

    public function defaults($defaults = 0) {
        $this->set('defaults', $defaults);
        return $this;
    }


    public function formatInput($value, $entry = NULL) {

        if ($format = $this['inputFormat']) {
            return $format($value, $entry, $this);
        }

        $foreign = Norm::factory($this['foreign']);
        $this['foreignLabel'] = 'value';

        if ($this['readonly']) {
            $criteria = array('groups'=>$this['foreignGroup'],'key'=>$value);
            $entry = $foreign->findOne($criteria);
            $label = $entry[$this['foreignLabel']];
            return '<span class="field">'.$label.'</span>';
        }


        $options = array();
        $entries = $foreign->find(array('groups'=>$this['foreignGroup']))->sort(array('key' => 1));

        if($this['defaults'] && empty($value)){
            $value = (string)$this['defaults'];
        }

        foreach ($entries as $entry) {
            $label = $entry['value'];
            $options[] = '<option value="'.$entry['key'].'" '.($entry['key'] === $value ? 'selected' : '').'>'.$label.'</option>';
        }

        return '<select name="'.$this['name'].'"><option value="">---</option>'.implode('', $options).'</select>';
    }

    public function cell($value, $entry = NULL) {
        $foreign = Norm::factory('Sysparam');
        $this['foreignLabel'] = 'value';
        $criteria = array('groups'=>$this['foreignGroup'],'key'=>$value);
        $entry = $foreign->findOne($criteria);
        $value = $entry[$this['foreignLabel']];
        if ($this->has('cellFormat') && $format = $this['cellFormat']) {
            return $format($value, $entry, $this);
        }
        return $value;
    }

    public function formatReadOnly($value, $entry = NULL) {
        $foreign = Norm::factory('Sysparam');
        $this['foreignLabel'] = 'value';
        $criteria = array('groups'=>$this['foreignGroup'],'key'=>$value);
        $entry = $foreign->findOne($criteria);
        $value = $entry[$this['foreignLabel']];
        if ($this->has('cellFormat') && $format = $this['cellFormat']) {
            return $format($value, $entry, $this);
        }
        return '<span class="field">'.$value.'</span>';
    }

    public function formatPlain($value, $entry = NULL) {
        $foreign = Norm::factory('Sysparam');
        $this['foreignLabel'] = 'value';
        $criteria = array('groups'=>$this['foreignGroup'],'key'=>$value);
        $entry = $foreign->findOne($criteria);
        $value = $entry[$this['foreignLabel']];
        if ($this->has('cellFormat') && $format = $this['cellFormat']) {
            return $format($value, $entry, $this);
        }
        return $value;
    }

    public function toJSON($value) {
        $foreign = Norm::factory('Sysparam');
        $this['foreignLabel'] = 'value';
        $criteria = array('groups'=>$this['foreignGroup'],'key'=>$value);
        $entry = $foreign->findOne($criteria);
        $value = $entry[$this['foreignLabel']];
        return $value;
    }
}
