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
            $stmt->execute();
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
    END: REST API for Bank
*/


