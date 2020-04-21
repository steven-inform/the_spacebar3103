<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PDO_Manager;

class TaskController extends AbstractController
{
    private $pdoManager;

    public function __construct( PDO_Manager $pdoManager )
    {
        $this->pdoManager = $pdoManager;
    }

    /**
     * @Route("/api/taken", name="api_getTasks", methods={"GET"})
     */
    public function getTasks()
    {
        $rows = $this->pdoManager->GetData( "select * from taak" );
        return $this->json([ 'rows' => $rows ]);
    }

    /**
     * @Route("/api/taak/{id}", name="api_getOneTask", methods={"GET"})
     */
    public function getOneTask($id)
    {
        $rows = $this->pdoManager->GetData( "select * from taak where taa_id=$id" );
        return $this->json([ 'rows' => $rows ]);
    }

    /**
 * @Route("/api/taken", name="api_createTask", methods={"POST"})
 */
    public function createTask()
    {
        $ins = "insert into taak SET taa_datum='" . $_POST['datum'] . "' , taa_omschr='" . $_POST['omschr'] . "'";
        $result = $this->pdoManager->Execute($ins);
        return $this->json([ 'result' => $result ]);
    }

    /**
     * @Route("/api/taak/{id}", name="api_updateTask", methods={"PUT"})
     */
    public function updateTask($id)
    {
        $data = json_decode(file_get_contents("php://input"));

        $ins = "update taak SET taa_datum='" . $data->datum . "' , taa_omschr='" . $data->omschr . "' where taa_id=$id";
        $result = $this->pdoManager->Execute($ins);
        return $this->json([ 'result' => $result ]);
    }

    /**
     * @Route("/api/taak/{id}", name="api_deleteTask", methods={"DELETE"})
     */
    public function deleteTask($id)
    {
        $del = "delete from taak where taa_id=$id";
        $result = $this->pdoManager->Execute($del);
        return $this->json([ 'result' => $result ]);
    }

}