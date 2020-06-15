<?php
    function addProductImage($product_id, $src_image, $position)
    {
        $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
        $my_file_extension = pathinfo( $_FILES[$src_image]['name'] , PATHINFO_EXTENSION);

        if (in_array($my_file_extension , $allowed_extensions))
        {
            $new_file_name = $product_id . '.' . $my_file_extension;
            $destination = '../assets/images/products/' . $new_file_name;
            $result = move_uploaded_file($_FILES[$src_image]['tmp_name'], $destination);
            $db = dbConnect();
            $query = $db->prepare("INSERT INTO images (src_image, position, product_id) VALUES (:src_image, :position, :product_id) ");
            $result =  $query->execute([
                ':src_image' => $new_file_name,
                ':position' => $position,
                ':product_id' => $product_id]);
            return $result;
        }

        return false;
    }