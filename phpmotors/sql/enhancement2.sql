
/*
    $conn->insert("clients", [
        "clientFirstname" => "Tony",
        "clientLastname" => "Stark",
        "clientEmail" => "tony@starkent.com",
        "clientPassword" => "Iam1ronM@an", # I would encrypt this..
        "comment" => "I am the real Ironman"
    ])->getSql()

    Insert the following new client to the clients table (Note: The clientId and clientLevel fields should handle their own values and do not need to be part of this query.):
Tony, Stark, tony@starkent.com, Iam1ronM@n, "I am the real Ironman"
*/

INSERT INTO `clients` (`clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `comment`) VALUES  ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

/*
    $conn->update("clients", [
        "clientLevel" => 3
    ])->where(["clientId" => 1])->getSql()

    Modify the Tony Stark record to change the clientLevel to 3. The previous insert query will have to have been stored in the database for the update query to work.
*/

UPDATE `clients` SET `clientLevel` = '3' WHERE `clientId` = '1';

/*
    $conn->update("inventory", [
        "invDescription" => "REPLACE(invDescription, 'small interior', 'spacious interior')"
    ], false)->where(["invId" => 12])->getSql()
    Modify the "GM Hummer" record to read "spacious interior" rather than "small interior" using a single query.
*/

UPDATE `inventory` SET `invDescription` = 'Do you have 6 kids and like to go off-roading? The Hummer gives you the spacious interiors with an engine to get you out of any muddy or rocky situation.' WHERE `invId` = '12';

/*

    $conn->select("inventory", ["invModel"])
    ->innerJoin("carclassification", "inventory.classificationId = carclassification.classificationId")
    ->where(["carclassification.classificationName" => "SUV"])
    ->getSql();
    Use an inner join to select the invModel field from the inventory table and the classificationName field from the carclassification table for inventory items that belong to the "SUV" category.
*/

SELECT invModel FROM inventory INNER JOIN carclassification ON inventory.classificationId=carclassification.classificationId WHERE carclassification.classificationName = 'SUV';

/*

    $conn->delete("inventory")->where(["invId" => 1])->getSql();
    Delete the Jeep Wrangler from the database.

*/

DELETE FROM inventory WHERE invId = '1';


/*

    $conn->update("inventory", [
        "invImage" => "concat('/phpmotors', invImage)",
        "invThumbnail" => "concat('/phpmotors', invThumbnail)"
        ], false)->getSql();
    Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage and invThumbnail columns using a single query.
*/

UPDATE inventory SET invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);

