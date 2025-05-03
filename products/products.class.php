<?php
class Product
{
    private $productID;
    private $adminLoginID;
    private $productName;
    private $productType;
    private $productDescription;
    private $productManufacturer;
    private $productImage;
    private $productLink;

    public function __construct($productName, $productType, $productDescription, $productManufacturer, $productImage, $productLink, $productID, $adminLoginID = null)
    {
        $this->productName = $productName;
        $this->productType = $productType;
        $this->productDescription = $productDescription;
        $this->productManufacturer = $productManufacturer;
        $this->productImage = $productImage;
        $this->productLink = $productLink;
        $this->productID = $productID;
        $this->adminLoginID = $adminLoginID;
    }

    public function getProductID()
    {
        return $this->productID;
    }

    public function getAdminLoginID()
    {
        return $this->adminLoginID;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductType()
    {
        return $this->productType;
    }

    public function getProductDescription()
    {
        return $this->productDescription;
    }

    public function getProductManufacturer()
    {
        return $this->productManufacturer;
    }

    public function getProductImage()
    {
        return $this->productImage;
    }

    public function getProductLink()
    {
        return $this->productLink;
    }
}