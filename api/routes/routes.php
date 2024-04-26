<?php
date_default_timezone_set("Asia/Kolkata");
session_start();

use FFI\Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

require_once '../config/db.php';

$base = '/erpProject/api';

// Function to move uploaded file to a directory.
function moveUploadedFile($uploadedFile, $uploadDirectory)
{
    if ($uploadedFile->getClientFilename() == "") {
        return "";
    }

    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '_' . time() . '.' . $extension;
    $uploadedFile->moveTo($uploadDirectory . $uniqueFileName);
    return $uniqueFileName;  // Return only the unique filename, not the full path
}

// Function to return financial year
function getFinancialYear()
{
    if (date('m') > 3) {
        return date('Y')  . '-' . date('Y') + 1;
    } else {
        return date('Y') - 1 . '-' . date('Y');
    }
}

/*
    BEIGN: REST API for Bank
*/
$app->group("$base/bank", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM bank";
            $stmt = $conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->get("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $bank_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM bank WHERE bank_id=:bank_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bank_id', $bank_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->post("", function (Request $request, Response $response) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "INSERT INTO bank (bank_name, address) VALUES (:bank_name, :address)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bank_name', $parameters['bank_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->put("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE bank SET bank_name=:bank_name, address=:address, updated_at=NOW() WHERE bank_id=:bank_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bank_id', $parameters['bank_id']);
            $stmt->bindParam(':bank_name', $parameters['bank_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->delete("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM bank WHERE bank_id=:bank_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bank_id', $args['id']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });
});
/*
    END: REST API for Bank
*/
/*
    BEIGN: REST API for STATE
*/
$app->group("$base/state", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM state";
            $stmt = $conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->get("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $bank_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM state WHERE state_id=:state_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':state_id', $state_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->post("", function (Request $request, Response $response) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "INSERT INTO state (state_name, country_name,code,gst_code) VALUES (:state_name, :country_name, :code, :gst_code)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':state_name', $parameters['state_name']);
            $stmt->bindParam(':country_name', $parameters['country_name']);
            $stmt->bindParam(':code', $parameters['code']);
            $stmt->bindParam(':gst_code', $parameters['gst_code']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->put("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE state SET state_name=:state_name, country_name=:country_name, code=:code, gst_code=:gst_code, updated_at=NOW() WHERE state_id=:state_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':state_id', $parameters['state_id']);
            $stmt->bindParam(':state_name', $parameters['state_name']);
            $stmt->bindParam(':country_name', $parameters['country_name']);
            $stmt->bindParam(':code', $parameters['code']);
            $stmt->bindParam(':gst_code', $parameters['gst_code']);
            $stmt->execute();
           

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->delete("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM state WHERE state_id=:state_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':state_id', $args['id']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });
});
/*
    END: REST API for state
*/

// *
//     BEIGN: REST API for vendor registration
// */
$app->group("$base/registration", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM vendor_reg";
            $stmt = $conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->get("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $vreg_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM vendor_reg WHERE vreg_id=:vreg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':vreg_id', $vreg_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->post("", function (Request $request, Response $response) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "INSERT INTO vendor_reg (vendor_type,documents,qms) VALUES (:vendor_type,:documents,:qms)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':vendor_type', $parameters['vendor_type']);
            $stmt->bindParam(':documents', $parameters['documents']);
            $stmt->bindParam(':qms', $parameters['qms']);
            
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->put("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE vendor_reg SET vendor_type=:vendor_type, documents=:documents, qms=:qms,  updated_at=NOW() WHERE vreg_id=:vreg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':vreg_id', $parameters['vreg_id']);
            $stmt->bindParam(':vendor_type', $parameters['vendor_type']);
            $stmt->bindParam(':documents', $parameters['documents']);
            $stmt->bindParam(':qms', $parameters['qms']);
           
            $stmt->execute();
            
            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->delete("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM vendor_reg WHERE vreg_id=:vreg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':vreg_id', $args['id']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });
});
/*
    END: REST API for vendor registration
*/

// *
//     BEIGN: REST API for departement
// */
$app->group("$base/department", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM department";
            $stmt = $conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->get("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $vreg_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM department WHERE department_id=:department_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':department_id', $department_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->post("", function (Request $request, Response $response) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "INSERT INTO department (name,d_hod,cost_center) VALUES (:name,:d_hod,:cost_center)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $parameters['name']);
            $stmt->bindParam(':d_hod', $parameters['d_hod']);
            $stmt->bindParam(':cost_center', $parameters['cost_center']);
            
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->put("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE department SET name=:name, d_hod=:d_hod, cost_center=:cost_center,  updated_at=NOW() WHERE department_id=:department_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':department_id', $parameters['department_id']);
            $stmt->bindParam(':name', $parameters['name']);
            $stmt->bindParam(':d_hod', $parameters['d_hod']);
            $stmt->bindParam(':cost_center', $parameters['cost_center']);
           
            $stmt->execute();
           
            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->delete("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM department WHERE department_id=:department_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':department_id', $args['id']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });
});
/*
    END: REST API for department
*/


/*
    BEIGN: REST API for process
*/
$app->group("$base/process", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM process";
            $stmt = $conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->get("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $bank_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM process WHERE process_id=:process_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':process_id', $process_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->post("", function (Request $request, Response $response) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "INSERT INTO process (p_name, short_name) VALUES (:p_name, :short_name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_name', $parameters['p_name']);
            $stmt->bindParam(':short_name', $parameters['short_name']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->put("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE process SET p_name=:p_name, short_name=:short_name, updated_at=NOW() WHERE process_id=:process_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':process_id', $parameters['process_id']);
            $stmt->bindParam(':p_name', $parameters['p_name']);
            $stmt->bindParam(':short_name', $parameters['short_name']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });

    $group->delete("/{id}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM process WHERE process_id=:process_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':process_id', $args['id']);
            $stmt->execute();

            $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
            $conn = null;

            $status = 200;
            $data = array("status" => "Ok", "msg" => $msg);
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        }

        $output = json_encode($data);

        $response->getBody()->write($output);
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus($status);
    });
});
/*
    END: REST API for process
*/





