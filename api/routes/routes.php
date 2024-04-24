<?php
date_default_timezone_set("Asia/Kolkata");
session_start();

use FFI\Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

require_once '../config/db.php';

$base = '/hindalco/api';

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
    BEIGN: REST API for Branch
*/
$app->group("$base/branch", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM branch";
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
            $branch_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM branch WHERE branch_id=:branch_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':branch_id', $branch_id);
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

            $sql = "INSERT INTO branch (branch_name, phone,email, address_line1, address_line2, city, state, pincode, tin_no, gst_no, bank_id) VALUES (:branch_name, :phone, :email, :address_line1, :address_line2, :city, :state, :pincode, :tin_no, :gst_no, :bank_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':branch_name', $parameters['branch_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':address_line1', $parameters['address_line1']);
            $stmt->bindParam(':address_line2', $parameters['address_line2']);
            $stmt->bindParam(':city', $parameters['city']);
            $stmt->bindParam(':state', $parameters['state']);
            $stmt->bindParam(':pincode', $parameters['pincode']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gst_no', $parameters['gst_no']);
            $stmt->bindParam(':bank_id', $parameters['bank_id']);

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

            $sql = "UPDATE branch SET branch_name=:branch_name, phone=:phone, email=:email, address_line1=:address_line1, address_line2=:address_line2, city=:city, state=:state, pincode=:pincode, tin_no=:tin_no, gst_no=:gst_no, bank_id=:bank_id, updated_at=NOW() WHERE branch_id=:branch_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':branch_id', $parameters['branch_id']);
            $stmt->bindParam(':branch_name', $parameters['branch_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':address_line1', $parameters['address_line1']);
            $stmt->bindParam(':address_line2', $parameters['address_line2']);
            $stmt->bindParam(':city', $parameters['city']);
            $stmt->bindParam(':state', $parameters['state']);
            $stmt->bindParam(':pincode', $parameters['pincode']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gst_no', $parameters['gst_no']);
            $stmt->bindParam(':bank_id', $parameters['bank_id']);
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

            $sql = "DELETE FROM branch WHERE branch_id=:branch_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':branch_id', $args['id']);
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
    END: REST API for Branch
*/

/*
    BEIGN: REST API for Item
*/
$app->group("$base/item", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM item";
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

    $group->get("/{code}", function (Request $request, Response $response, array $args) {
        try {
            $item_code = $args['code'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM item WHERE item_code=:item_code";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_code', $item_code);
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

            $sql = "INSERT INTO item (item_code, item_name, category, description, mfg_company_id, location, rate, packing, hsn_code, gst, gst_flag, qty, min_stock, max_stock) VALUES (:item_code, :item_name, :category, :description, :mfg_company_id, :location, :rate, :packing, :hsn_code, :gst, :gst_flag, :qty, :min_stock, :max_stock)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_code', $parameters['item_code']);
            $stmt->bindParam(':item_name', $parameters['item_name']);
            $stmt->bindParam(':category', $parameters['category']);
            $stmt->bindParam(':description', $parameters['description']);
            $stmt->bindParam(':mfg_company_id', $parameters['mfg_company_id']);
            $stmt->bindParam(':location', $parameters['location']);
            $stmt->bindParam(':rate', $parameters['rate']);
            $stmt->bindParam(':packing', $parameters['packing']);
            $stmt->bindParam(':hsn_code', $parameters['hsn_code']);
            $stmt->bindParam(':gst', $parameters['gst']);
            $stmt->bindParam(':gst_flag', $parameters['gst_flag']);
            $stmt->bindParam(':qty', $parameters['qty']);
            $stmt->bindParam(':min_stock', $parameters['min_stock']);
            $stmt->bindParam(':max_stock', $parameters['max_stock']);
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

    $group->put("/{code}", function (Request $request, Response $response, array $args) {
        try {
            $parameters = $request->getParsedBody();

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "UPDATE item SET item_code=:item_code, item_name=:item_name, category=:category, description=:description, mfg_company_id=:mfg_company_id, location=:location, rate=:rate, packing=:packing, hsn_code=:hsn_code, gst=:gst, gst_flag=:gst_flag, qty=:qty, min_stock=:min_stock, max_stock=:max_stock, updated_at=NOW() WHERE item_code=:item_code";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_code', $parameters['item_code']);
            $stmt->bindParam(':item_name', $parameters['item_name']);
            $stmt->bindParam(':category', $parameters['category']);
            $stmt->bindParam(':description', $parameters['description']);
            $stmt->bindParam(':mfg_company_id', $parameters['mfg_company_id']);
            $stmt->bindParam(':location', $parameters['location']);
            $stmt->bindParam(':rate', $parameters['rate']);
            $stmt->bindParam(':packing', $parameters['packing']);
            $stmt->bindParam(':hsn_code', $parameters['hsn_code']);
            $stmt->bindParam(':gst', $parameters['gst']);
            $stmt->bindParam(':gst_flag', $parameters['gst_flag']);
            $stmt->bindParam(':gst_amt', $gst_amt);
            $stmt->bindParam(':qty', $parameters['qty']);
            $stmt->bindParam(':min_stock', $parameters['min_stock']);
            $stmt->bindParam(':max_stock', $parameters['max_stock']);
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

    $group->delete("/{code}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "DELETE FROM item WHERE item_code=:item_code";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_code', $args['code']);
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
    END: REST API for Item
*/

/*
    BEIGN: REST API for Mfg Company
*/
$app->group("$base/mfg_company", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM mfg_company";
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
            $mfg_company_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM mfg_company WHERE mfg_company_id=:mfg_company_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mfg_company_id', $mfg_company_id);
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

            $sql = "INSERT INTO mfg_company (mfg_company_name, address, phone, email) VALUES (:mfg_company_name, :address, :phone, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mfg_company_name', $parameters['mfg_company_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
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

            $sql = "UPDATE mfg_company SET mfg_company_name=:mfg_company_name, address=:address, phone=:phone, email=:email, updated_at=NOW() WHERE mfg_company_id=:mfg_company_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mfg_company_id', $parameters['mfg_company_id']);
            $stmt->bindParam(':mfg_company_name', $parameters['mfg_company_name']);
            $stmt->bindParam(':address', $parameters['address']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
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

            $sql = "DELETE FROM mfg_company WHERE mfg_company_id=:mfg_company_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mfg_company_id', $args['id']);
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
    END: REST API for Mfg Company
*/

/*
    BEIGN: REST API for Supplier
*/
$app->group("$base/supplier", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM supplier";
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
            $supplier_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM supplier WHERE supplier_id=:supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':supplier_id', $supplier_id);
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

            $sql = "INSERT INTO supplier (supplier_name, phone, email, address_line1, address_line2, city, state, pincode, tin_no, gst_no, pan_no) VALUES (:supplier_name, :phone, :email, :address_line1, :address_line2, :city, :state, :pincode, :tin_no, :gst_no, :pan_no)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':supplier_name', $parameters['supplier_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':address_line1', $parameters['address_line1']);
            $stmt->bindParam(':address_line2', $parameters['address_line2']);
            $stmt->bindParam(':city', $parameters['city']);
            $stmt->bindParam(':state', $parameters['state']);
            $stmt->bindParam(':pincode', $parameters['pincode']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gst_no', $parameters['gst_no']);
            $stmt->bindParam(':pan_no', $parameters['pan_no']);
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

            $sql = "UPDATE supplier SET supplier_name=:supplier_name, phone=:phone, email=:email, address_line1=:address_line1, address_line2=:address_line2, city=:city, state=:state, pincode=:pincode, tin_no=:tin_no, gst_no=:gst_no, pan_no=:pan_no, updated_at=NOW() WHERE supplier_id=:supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':supplier_id', $parameters['supplier_id']);
            $stmt->bindParam(':supplier_name', $parameters['supplier_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':address_line1', $parameters['address_line1']);
            $stmt->bindParam(':address_line2', $parameters['address_line2']);
            $stmt->bindParam(':city', $parameters['city']);
            $stmt->bindParam(':state', $parameters['state']);
            $stmt->bindParam(':pincode', $parameters['pincode']);
            $stmt->bindParam(':tin_no', $parameters['tin_no']);
            $stmt->bindParam(':gst_no', $parameters['gst_no']);
            $stmt->bindParam(':pan_no', $parameters['pan_no']);
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

            $sql = "DELETE FROM supplier WHERE supplier_id=:supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':supplier_id', $args['id']);
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
    END: REST API for Supplier
*/

/*
    BEIGN: REST API for Item_Supplier
*/
$app->group("$base/item_supplier", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM item_supplier";
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
            $item_supplier_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM item_supplier WHERE item_supplier_id=:item_supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_supplier_id', $item_supplier_id);
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

            $sql = "INSERT INTO item_supplier (item_code, supplier_id) VALUES (:item_code, :barcode, :supplier_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_code', $parameters['item_code']);
            $stmt->bindParam(':supplier_id', $parameters['supplier_id']);
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

            $sql = "UPDATE item_supplier SET item_code=:item_code, supplier_id=:supplier_id, updated_at=NOW() WHERE item_supplier_id=:item_supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_supplier_id', $parameters['item_supplier_id']);
            $stmt->bindParam(':item_code', $parameters['item_code']);
            $stmt->bindParam(':supplier_id', $parameters['supplier_id']);
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

            $sql = "DELETE FROM item_supplier WHERE item_supplier_id=:item_supplier_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item_supplier_id', $args['id']);
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
    END: REST API for Item_Supplier
*/

/*
    BEIGN: REST API for Customer
*/
$app->group("$base/customer", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM customer";
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
            $customer_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM customer WHERE customer_id=:customer_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_id', $customer_id);
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

    // GET Customer details through phone
    $group->get("/phone/{phone}", function (Request $request, Response $response, array $args) {
        try {
            $phone = intval($args['phone']);

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM customer WHERE phone=:phone";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$data) {
                throw new Exception('Customer is not registered');
            } 

            $conn = null;

            $status = 200;
        } catch (PDOException $e) {
            $data = array("status" => "Error", "msg" => $e->getMessage());
            $status = 400;
        } catch (Exception $e) {
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

            $sql = "INSERT INTO customer (customer_name, phone, email, address) VALUES (:customer_name, :phone, :email, :address)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_name', $parameters['customer_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
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

            $sql = "UPDATE customer SET customer_name=:customer_name, phone=:phone, email=:email, address=:address, updated_at=NOW() WHERE customer_id=:customer_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_id', $parameters['customer_id']);
            $stmt->bindParam(':customer_name', $parameters['customer_name']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':email', $parameters['email']);
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

            $sql = "DELETE FROM customer WHERE customer_id=:customer_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_id', $args['id']);
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
    END: REST API for Customer
*/

/*
    BEIGN: REST API for User
*/
$app->group("$base/user", function (Group $group) {
    $group->get("", function (Request $request, Response $response) {
        try {
            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM user";
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
            $user_id = $args['id'];

            $conn = new DB;
            $conn = $conn->connect();

            $sql = "SELECT * FROM user WHERE user_id=:user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
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

            $sql = "INSERT INTO user (user_name, password, email, phone, user_type, is_active) VALUES (:user_name, :password, :email, :phone, user_type, is_active)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_name', $parameters['user_name']);
            $stmt->bindParam(':password', $parameters['password']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':user_type', $parameters['user_type']);
            $stmt->bindParam(':is_active', $parameters['is_active']);
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

            $sql = "UPDATE user SET user_name=:user_name, password=:password, email=:email, phone=:phone, user_type=:user_type is_active=:is_active, updated_at=NOW() WHERE user_id=:user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $parameters['user_id']);
            $stmt->bindParam(':user_name', $parameters['user_name']);
            $stmt->bindParam(':password', $parameters['password']);
            $stmt->bindParam(':email', $parameters['email']);
            $stmt->bindParam(':phone', $parameters['phone']);
            $stmt->bindParam(':user_type', $parameters['user_type']);
            $stmt->bindParam(':is_active', $parameters['is_active']);

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

            $sql = "DELETE FROM user WHERE user_id=:user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $args['id']);
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
    END: REST API for User
*/



/*
    END: REST API for User
*/


/*
 *
 * 
 * 
    Sales
 *
 * 
 * 
*/


/*
    BEIGN: REST API for Fetching Batch From Stock By Item
*/
$app->get("$base/stock_item/{code}", function (Request $request, Response $response, array $args) {
    try {
        $item_code = $args['code'];

        $conn = new DB;
        $conn = $conn->connect();

        // Check if item exist 
        $result = $conn->query("SELECT item_code FROM item WHERE item_code = $item_code")->fetch();
        if (!$result) {
            throw new Exception("Unkown Item", 1);
        }

        $sql = "SELECT stock_id, s.item_code, s.qty, batch_no, exp_date, sales_rate, disc_per, item_name, gst, gst_flag FROM stock s 
                INNER JOIN item i ON s.item_code = i.item_code 
                WHERE s.item_code = :item_code AND s.qty > 0 
                ORDER BY exp_date ASC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":item_code", $item_code);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$data) {
            throw new Exception('Item is not available in stock', 2);
        } 

        $conn = null;

        $status = 200;
    } catch (PDOException $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage());
        $status = 400;
    } catch (Exception $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage());
        $status = 400;
    }

    $output = json_encode($data);

    $response->getBody()->write($output);
    return $response->withHeader('Content-type', 'application/json')
        ->withStatus($status);
});
/*
    END: REST API for Fetching Batch From Stock By Item
*/

/*
    BEIGN: REST API for Sales
*/
$app->post("$base/sales", function (Request $request, Response $response) {
    try {
        $parameters = $request->getParsedBody();

        $conn = new DB;
        $conn = $conn->connect();

        $conn->beginTransaction();

        $sql = "INSERT INTO sales (amount, disc_amt, gst_amt, net_amt, payment_mode, payment_done, customer_id) VALUES (:amount, :disc_amt, :gst_amt, 0, :payment_mode, :payment_done, :customer_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':amount', $parameters['amount']);
        $stmt->bindParam(':disc_amt', $parameters['disc_amt']);
        $stmt->bindParam(':gst_amt', $parameters['gst_amt']);
        $stmt->bindParam(':payment_mode', $parameters['payment_mode']);
        $stmt->bindParam(':payment_done', $parameters['payment_done']);
        $stmt->bindParam(':customer_id', $parameters['customer_id']);
        $stmt->execute();

        $bill_no = $conn->lastInsertId();

        foreach ($parameters['items'] as $item) {
            $sql_item = "INSERT INTO sales_item (bill_no, item_code, qty, batch_no, exp_date, amount, disc_per, disc_amt, gst_amt, net_amt) VALUES (:bill_no, :item_code, :qty, :batch_no, CASE WHEN :exp_date = '' THEN NULL ELSE :exp_date END, :amount, :disc_per, :disc_amt, :gst_amt, :net_amt)";
            $stmt_item = $conn->prepare($sql_item);
            $stmt_item->bindParam(':bill_no', $bill_no);
            $stmt_item->bindParam(':item_code', $item['item_code']);
            $stmt_item->bindParam(':qty', $item['qty']);
            $stmt_item->bindParam(':batch_no', $item['batch_no']);
            $stmt_item->bindParam(':exp_date', $item['exp_date']);
            $stmt_item->bindParam(':amount', $item['amount']);
            $stmt_item->bindParam(':disc_per', $item['disc_per']);
            $stmt_item->bindParam(':disc_amt', $item['disc_amt']);
            $stmt_item->bindParam(':gst_amt', $item['gst_amt']);
            $stmt_item->bindParam(':net_amt', $item['net_amt']);
            $stmt_item->execute();
        }

        if ($parameters['payment_mode'] == 'Credit') {
            $sql_credit = "UPDATE Customer SET credit_score = credit_score + :net_amt WHERE customer_id = :customer_id";
            $stmt_credit = $conn->prepare($sql_credit);
            $stmt_credit->bindParam(':customer_id', $parameters['customer_id']);
            $stmt_credit->bindParam(':net_amt', $parameters['net_amt']);
            $stmt_credit->execute();
        }

        $sql_update = "UPDATE sales SET net_amt=:net_amt WHERE bill_no=:bill_no";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':bill_no', $bill_no);
        $stmt_update->bindParam(':net_amt', $parameters['net_amt']);
        $stmt_update->execute();

        $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";

        $conn->commit();

        $status = 200;
        $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
    } catch (PDOException $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
        $status = 400;

        $conn->rollBack();
    }

    $conn = null;

    $output = json_encode($data);

    $response->getBody()->write($output);
    return $response->withHeader('Content-type', 'application/json')
        ->withStatus($status);
});
/*
    END: REST API for Sales
*/


/*
 *
 * 
 * 
    Purchase
 *
 * 
 * 
*/


/*
    BEGIN: GET Item details for purchase
*/
$app->get("$base/item_pur/{code}", function (Request $request, Response $response, array $args) {
    try {
        $item_code = $args['code'];

        $conn = new DB;
        $conn = $conn->connect();

        $sql = "SELECT item_code, item_name, hsn_code, gst, gst_flag FROM item WHERE item_code=:item_code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item_code', $item_code);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$data) {
            throw new Exception('Unkown Items');
        }

        $conn = null;

        $status = 200;
    } catch (PDOException $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage());
        $status = 400;
    } catch (Exception $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage());
        $status = 400;
    } 

    $output = json_encode($data);

    $response->getBody()->write($output);
    return $response->withHeader('Content-type', 'application/json')
        ->withStatus($status);
});
/*
    END: GET Item details for purchase
*/

/*
    BEIGN: REST API for Purchase
*/
$app->post("$base/purchase", function (Request $request, Response $response) {
    try {
        $parameters = $request->getParsedBody();

        $conn = new DB;
        $conn = $conn->connect();

        $conn->beginTransaction();

        $sql = "INSERT INTO purchase (invoice_no, invoice_date, item_receive_date, amount, disc_amt, gst_amt, net_amt, payment_mode, payment_done, supplier_id) VALUES (:invoice_no, :invoice_date, :item_receive_date, :amount, :disc_amt, :gst_amt, 0, :payment_mode, :payment_done, :supplier_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':invoice_no', $parameters['invoice_no']);
        $stmt->bindParam(':invoice_date', $parameters['invoice_date']);
        $stmt->bindParam(':item_receive_date', $parameters['item_receive_date']);
        $stmt->bindParam(':amount', $parameters['amount']);
        $stmt->bindParam(':disc_amt', $parameters['disc_amt']);
        $stmt->bindParam(':gst_amt', $parameters['gst_amt']);
        $stmt->bindParam(':payment_mode', $parameters['payment_mode']);
        $stmt->bindParam(':payment_done', $parameters['payment_done']);
        $stmt->bindParam(':supplier_id', $parameters['supplier_id']);
        $stmt->execute();

        $grn_no = $conn->lastInsertId();

        foreach ($parameters['items'] as $item) {
            $sql_item = "INSERT INTO purchase_item (grn_no, item_code, qty, batch_no, exp_date, free_qty, purchase_rate, amount, disc_per, disc_amt, gst_amt, net_amt, sales_rate, sales_disc_per) VALUES (:grn_no, :item_code, :qty, :batch_no, CASE WHEN :exp_date='' THEN NULL ELSE :exp_date END, :free_qty, :purchase_rate, :amount, :disc_per, :disc_amt, :gst_amt, :net_amt, :sales_rate, :sales_disc_per)";
            $stmt_item = $conn->prepare($sql_item);
            $stmt_item->bindParam(':grn_no', $grn_no);
            $stmt_item->bindParam(':item_code', $item['item_code']);
            $stmt_item->bindParam(':qty', $item['qty']);
            $stmt_item->bindParam(':batch_no', $item['batch_no']);
            $stmt_item->bindParam(':exp_date', $item['exp_date']);
            $stmt_item->bindParam(':free_qty', $item['free_qty']);
            $stmt_item->bindParam(':purchase_rate', $item['purchase_rate']);
            $stmt_item->bindParam(':amount', $item['amount']);
            $stmt_item->bindParam(':disc_per', $item['disc_per']);
            $stmt_item->bindParam(':disc_amt', $item['disc_amt']);
            $stmt_item->bindParam(':gst_amt', $item['gst_amt']);
            $stmt_item->bindParam(':net_amt', $item['net_amt']);
            $stmt_item->bindParam(':sales_rate', $item['sales_rate']);
            $stmt_item->bindParam(':sales_disc_per', $item['sales_disc_per']);
            $stmt_item->execute();
        }

        $sql_update = "UPDATE purchase SET net_amt=:net_amt WHERE grn_no=:grn_no";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':grn_no', $grn_no);
        $stmt_update->bindParam(':net_amt', $parameters['net_amt']);
        $stmt_update->execute();

        $conn->commit();

        $msg = ($stmt->rowCount() > 0) ? "Success" : "No Update";
        
        $status = 200;
        $data = array("status" => "Ok", "msg" => $msg, "item" => $parameters);
    } catch (PDOException $e) {
        $data = array("status" => "Error", "msg" => $e->getMessage(), "item" => $parameters);
        $status = 400;

        $conn->rollBack();
    }

    $conn = null;

    $output = json_encode($data);

    $response->getBody()->write($output);
    return $response->withHeader('Content-type', 'application/json')
        ->withStatus($status);
});
/*
    END: REST API for Purchase
*/


/*
 *
 * 
 * 
    Report
 *
 * 
 * 
*/


/*
    BEGIN: REST API for Sales Report
*/
$app->group("$base/salesReport", function (Group $group) {
    $group->get("/{bill_no}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();
            $sql = "SELECT s.*,i.item_name FROM sales_item s
            LEFT JOIN item i ON s.item_code=i.item_code
            WHERE s.bill_no = :bill_no";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bill_no', $args['bill_no']);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
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
});
/*
    END: REST API for Sales Report
*/

/*
    BEGIN: REST API for puchase Report
*/
$app->group("$base/purchaseReport", function (Group $group) {
    $group->get("/{grn_no}", function (Request $request, Response $response, array $args) {
        try {
            $conn = new DB;
            $conn = $conn->connect();
            $sql = "SELECT * FROM purchase_item p
            
            WHERE p.grn_no = :grn_no";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':grn_no', $args['grn_no']);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
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
});
/*
    END: REST API for purchase  Report
*/
