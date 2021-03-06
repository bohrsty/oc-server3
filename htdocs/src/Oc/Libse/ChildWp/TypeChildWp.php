<?php
/***************************************************************************
 * for license information see doc/license.txt
 ***************************************************************************/

namespace Oc\Libse\ChildWp;

class TypeChildWp
{
    private $id;
    private $name;
    private $preposition;
    private $image;

    public function __construct($id, $name, $preposition, $image = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->preposition = $preposition;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPreposition()
    {
        return $this->preposition;
    }

    public function getImage()
    {
        return $this->image;
    }
}
