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
            $state_id = $args['id'];

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

            $sql = "UPDATE state SET state_name=:state_name, country_name=:country_name, code=:code, gst_code=:gst_code WHERE state_id=:state_id";
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
            $registration_id = $args['id'];

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

            $sql = "UPDATE vendor_reg SET vendor_type=:vendor_type, documents=:documents, qms=:qms WHERE vreg_id=:vreg_id";
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
            $department_id = $args['id'];

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

            $sql = "UPDATE department SET name=:name, d_hod=:d_hod, cost_center=:cost_center WHERE department_id=:department_id";
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
            $process_id = $args['id'];

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

            $sql = "UPDATE process SET p_name=:p_name, short_name=:short_name WHERE process_id=:process_id";
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


/*
    BEIGN: REST API for shift
*/
$app->group("$base/shift", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM shift";
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
            $shift_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM shift WHERE shift_id=:shift_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shift_id', $shift_id);
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

            $sql = "INSERT INTO shift (shift,in_time,out_time, deduction,grace) VALUES (:shift, :in_time,:out_time, :deduction,:grace)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shift', $parameters['shift']);
            $stmt->bindParam(':in_time', $parameters['in_time']);
            $stmt->bindParam(':out_time', $parameters['out_time']);
            $stmt->bindParam(':deduction', $parameters['deduction']);
            $stmt->bindParam(':grace', $parameters['grace']);
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

            $sql = "UPDATE shift SET shift=:shift, in_time=:in_time, out_time=:out_time, deduction=:deduction, grace=:grace WHERE shift_id=:shift_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shift_id', $parameters['shift_id']);
            $stmt->bindParam(':shift', $parameters['shift']);
            $stmt->bindParam(':in_time', $parameters['in_time']);
            $stmt->bindParam(':out_time', $parameters['out_time']);
            $stmt->bindParam(':deduction', $parameters['deduction']);
            $stmt->bindParam(':grace', $parameters['grace']);
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

            $sql = "DELETE FROM shift WHERE shift_id=:shift_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':shift_id', $args['id']);
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
    END: REST API for shift
*/


/*
    BEIGN: REST API for machine
*/
$app->group("$base/machine", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM machine";
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
            $machine_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM machine WHERE machine_id=:machine_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':machine_id', $machine_id);
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

            $sql = "INSERT INTO machine (m_name,short_name,m_no, make,location,nature_work,dept_name,controller) VALUES (:m_name, :short_name,:m_no, :make,:location, :nature_work, :dept_name, :controller)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':m_name', $parameters['m_name']);
            $stmt->bindParam(':short_name', $parameters['short_name']);
            $stmt->bindParam(':m_no', $parameters['m_no']);
            $stmt->bindParam(':make', $parameters['make']);
            $stmt->bindParam(':location', $parameters['location']);
             $stmt->bindParam(':nature_work', $parameters['nature_work']);
             $stmt->bindParam(':dept_name', $parameters['dept_name']);
             $stmt->bindParam(':controller', $parameters['controller']);
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

            $sql = "UPDATE machine SET m_name=:m_name, short_name=:short_name, m_no=:m_no, make=:make, location=:location , nature_work=:nature_work, dept_name=:dept_name, controller=:controller WHERE machine_id=:machine_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':machine_id', $parameters['machine_id']);
            $stmt->bindParam(':m_name', $parameters['m_name']);
            $stmt->bindParam(':short_name', $parameters['short_name']);
            $stmt->bindParam(':m_no', $parameters['m_no']);
            $stmt->bindParam(':make', $parameters['make']);
            $stmt->bindParam(':location', $parameters['location']);
            $stmt->bindParam(':nature_work', $parameters['nature_work']);
            $stmt->bindParam(':dept_name', $parameters['dept_name']);
            $stmt->bindParam(':controller', $parameters['controller']);
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

            $sql = "DELETE FROM machine WHERE machine_id=:machine_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':machine_id', $args['id']);
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
    END: REST API for machine
*/


/*
    BEIGN: REST API for currency
*/
$app->group("$base/currency", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM currency";
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
            $currency_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM currency WHERE currency_id=:currency_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':currency_id', $currency_id);
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

            $sql = "INSERT INTO currency (country_name,currency) VALUES (:country_name, :currency)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country_name', $parameters['country_name']);
            $stmt->bindParam(':currency', $parameters['currency']);
            
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

            $sql = "UPDATE currency SET country_name=:country_name, currency=:currency WHERE currency_id=:currency_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':currency_id', $parameters['currency_id']);
            $stmt->bindParam(':country_name', $parameters['country_name']);
            $stmt->bindParam(':currency', $parameters['currency']);
           
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

            $sql = "DELETE FROM currency WHERE currency_id=:currency_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':currency_id', $args['id']);
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
    END: REST API for currency
*/


/*
    BEIGN: REST API for PARTYGROUP
*/
$app->group("$base/partygroup", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM partygroup";
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
            $partyg_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM partygroup WHERE partyg_id=:partyg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':partyg_id', $partyg_id);
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

            $sql = "INSERT INTO partygroup (partyg_name) VALUES (:partyg_name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':partyg_name', $parameters['partyg_name']);
           
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

            $sql = "UPDATE partygroup SET partyg_name=:partyg_name WHERE partyg_id=:partyg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':partyg_id', $parameters['partyg_id']);
            $stmt->bindParam(':partyg_name', $parameters['partyg_name']);
           
           
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

            $sql = "DELETE FROM partygroup WHERE partyg_id=:partyg_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':partyg_id', $args['id']);
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
    END: REST API for currency
*/

/*
    BEIGN: REST API for COUNTRY
*/
$app->group("$base/country", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM country";
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
            $country_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM country WHERE country_id=:country_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country_id', $country_id);
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

            $sql = "INSERT INTO country (name, currency) VALUES (:name, :currency)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $parameters['name']);
            $stmt->bindParam(':currency', $parameters['currency']);
           
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

            $sql = "UPDATE country SET name=:name, currency=:currency WHERE country_id=:country_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country_id', $parameters['country_id']);
            $stmt->bindParam(':name', $parameters['name']);
            $stmt->bindParam(':currency', $parameters['currency']);
            
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

            $sql = "DELETE FROM country WHERE country_id=:country_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':country_id', $args['id']);
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
    END: REST API for country
*/

/*
    BEIGN: REST API for party
*/
$app->group("$base/party", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM party";
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
            $party_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM party WHERE party_id=:party_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':party_id', $party_id);
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

            $sql = "INSERT INTO party (party_name, alias, partyg_name, address, pin, city_name, contact, email, division, range_at, grace_days, credit_days, tds_per, disc_per, distance, p_type, bank_name, cheque, ledger, tin_no, gstin, pan_no, service_tax_no, handling_charge, micr_code, ifsc_code, account_no, account_type) VALUES (:party_name, :alias, :partyg_name, :address, :pin, :city_name, :contact, :email, :division, :range_at, :grace_days, :credit_days,:tds_per, :disc_per, :distance , :p_type, :bank_name, :cheque, :ledger, :tin_no, :gstin, :pan_no, :service_tax_no, :handling_charge, :micr_code, :ifsc_code, :account_no, :account_type)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':party_name', $parameters['party_name']);
            $stmt->bindParam(':alias', $parameters['alias']);
            $stmt->bindParam(':partyg_name', $parameters['partyg_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->bindParam(':pin', $parameters['pin']);
            $stmt->bindParam(':city_name', $parameters['city_name']);
            $stmt->bindParam(':contact', $parameters['contact']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':division', $parameters['division']);
            $stmt->bindParam(':range_at', $parameters['range_at']);
            $stmt->bindParam(':grace_days', $parameters['grace_days']);
            $stmt->bindParam(':credit_days', $parameters['credit_days']);
            $stmt->bindParam(':tds_per', $parameters['tds_per']);
            $stmt->bindParam(':disc_per', $parameters['disc_per']);
            $stmt->bindParam(':distance', $parameters['distance']);
            $stmt->bindParam(':p_type', $parameters['p_type']);
            
            $stmt->bindParam(':bank_name', $parameters['bank_name']);
            $stmt->bindParam(':cheque', $parameters['cheque']);
            $stmt->bindParam(':ledger', $parameters['ledger']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gstin', $parameters['gstin']);
            $stmt->bindParam(':pan_no', $parameters['pan_no']);
            $stmt->bindParam(':service_tax_no', $parameters['service_tax_no']);
            $stmt->bindParam(':handling_charge', $parameters['handling_charge']);
            $stmt->bindParam(':micr_code', $parameters['micr_code']);
            $stmt->bindParam(':ifsc_code', $parameters['ifsc_code']);
            $stmt->bindParam(':account_no', $parameters['account_no']);
            $stmt->bindParam(':account_type', $parameters['account_type']);
            
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

            $sql = "UPDATE party SET party_name=:party_name, alias=:alias,partyg_name=:partyg_name,address=:address,pin=:pin,city_name=:city_name , contact=:contact,email=:email, division=:division, range_at=:range_at, grace_days=:grace_days, credit_days=:credit_days,tds_per=:tds_per, disc_per=:disc_per, distance=:distance, p_type=:p_type, bank_name=:bank_name, cheque=:cheque, ledger=:ledger, tin_no=:tin_no, gstin=:gstin, pan_no=:pan_no, service_tax_no=:service_tax_no, handling_charge=:handling_charge, micr_code=:micr_code, ifsc_code=:ifsc_code , account_no=:account_no, account_type=:account_type WHERE party_id=:party_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':party_id', $parameters['party_id']);
            $stmt->bindParam(':party_name', $parameters['party_name']);
            $stmt->bindParam(':alias', $parameters['alias']);
            $stmt->bindParam(':partyg_name', $parameters['partyg_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->bindParam(':pin', $parameters['pin']);
            $stmt->bindParam(':city_name', $parameters['city_name']);
            $stmt->bindParam(':contact', $parameters['contact']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':division', $parameters['division']);
            $stmt->bindParam(':range_at', $parameters['range_at']);
            $stmt->bindParam(':grace_days', $parameters['grace_days']);
            $stmt->bindParam(':credit_days', $parameters['credit_days']);
            $stmt->bindParam(':tds_per', $parameters['tds_per']);
            $stmt->bindParam(':disc_per', $parameters['disc_per']);
            $stmt->bindParam(':distance', $parameters['distance']);
            $stmt->bindParam(':p_type', $parameters['p_type']);
            $stmt->bindParam(':bank_name', $parameters['bank_name']);
            $stmt->bindParam(':cheque', $parameters['cheque']);
            $stmt->bindParam(':ledger', $parameters['ledger']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gstin', $parameters['gstin']);
            
            $stmt->bindParam(':pan_no', $parameters['pan_no']);
            $stmt->bindParam(':service_tax_no', $parameters['service_tax_no']);
            $stmt->bindParam(':handling_charge', $parameters['handling_charge']);
            $stmt->bindParam(':micr_code', $parameters['micr_code']);
            $stmt->bindParam(':ifsc_code', $parameters['ifsc_code']);
            $stmt->bindParam(':account_no', $parameters['account_no']);
            $stmt->bindParam(':account_type', $parameters['account_type']);
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

            $sql = "DELETE FROM party WHERE party_id=:party_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':party_id', $args['id']);
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
    END: REST API for party
*/

