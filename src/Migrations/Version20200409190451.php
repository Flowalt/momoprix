<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409190451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address CHANGE customer_idcustomer customer_idcustomer INT DEFAULT NULL, CHANGE elevator elevator TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE category_has_category DROP name');
        $this->addSql('ALTER TABLE category_has_category RENAME INDEX fk_category_has_category_category1_idx TO IDX_CDFDC0678A8701B2');
        $this->addSql('ALTER TABLE category_has_category RENAME INDEX fk_category_has_category_category2_idx TO IDX_CDFDC067A639BA16');
        $this->addSql('DROP INDEX email_UNIQUE ON customer');
        $this->addSql('ALTER TABLE customer CHANGE password password VARCHAR(254) NOT NULL, CHANGE date_of_birth date_of_birth DATE DEFAULT \'NULL\', CHANGE created created DATETIME DEFAULT \'current_timestamp()\', CHANGE updated updated DATETIME DEFAULT \'current_timestamp()\'');
        $this->addSql('ALTER TABLE favoris RENAME INDEX fk_customer_has_product_customer1_idx TO IDX_8933C432D625C286');
        $this->addSql('ALTER TABLE favoris RENAME INDEX fk_customer_has_product_product1_idx TO IDX_8933C43262EEE04E');
        $this->addSql('ALTER TABLE delivery CHANGE order_idorder order_idorder INT DEFAULT NULL, CHANGE address_idaddress address_idaddress INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE customer_idcustomer customer_idcustomer INT DEFAULT NULL, CHANGE address_idaddress address_idaddress INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE category_idcategory category_idcategory INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_has_order DROP qte');
        $this->addSql('ALTER TABLE product_has_order RENAME INDEX fk_product_has_order_product1_idx TO IDX_600035AB62EEE04E');
        $this->addSql('ALTER TABLE product_has_order RENAME INDEX fk_product_has_order_order1_idx TO IDX_600035ABD55656CA');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address CHANGE customer_idcustomer customer_idcustomer INT NOT NULL, CHANGE elevator elevator TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE category_has_category ADD name VARCHAR(50) CHARACTER SET utf8 DEFAULT \'NULL\' COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE category_has_category RENAME INDEX idx_cdfdc0678a8701b2 TO fk_category_has_category_category1_idx');
        $this->addSql('ALTER TABLE category_has_category RENAME INDEX idx_cdfdc067a639ba16 TO fk_category_has_category_category2_idx');
        $this->addSql('ALTER TABLE customer CHANGE password password VARCHAR(80) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE date_of_birth date_of_birth DATE NOT NULL, CHANGE created created DATETIME NOT NULL, CHANGE updated updated DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX email_UNIQUE ON customer (email)');
        $this->addSql('ALTER TABLE delivery CHANGE address_idaddress address_idaddress INT NOT NULL, CHANGE order_idorder order_idorder INT NOT NULL');
        $this->addSql('ALTER TABLE favoris RENAME INDEX idx_8933c432d625c286 TO fk_customer_has_product_customer1_idx');
        $this->addSql('ALTER TABLE favoris RENAME INDEX idx_8933c43262eee04e TO fk_customer_has_product_product1_idx');
        $this->addSql('ALTER TABLE `order` CHANGE address_idaddress address_idaddress INT NOT NULL, CHANGE customer_idcustomer customer_idcustomer INT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE category_idcategory category_idcategory INT NOT NULL');
        $this->addSql('ALTER TABLE product_has_order ADD qte SMALLINT DEFAULT 1');
        $this->addSql('ALTER TABLE product_has_order RENAME INDEX idx_600035ab62eee04e TO fk_product_has_order_product1_idx');
        $this->addSql('ALTER TABLE product_has_order RENAME INDEX idx_600035abd55656ca TO fk_product_has_order_order1_idx');
    }
}
