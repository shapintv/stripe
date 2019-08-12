<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Exception\InvalidArgumentException;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Balance\Balance;
use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\Charge\Charge;
use Shapin\Stripe\Model\Coupon\Coupon;
use Shapin\Stripe\Model\Customer\Customer;
use Shapin\Stripe\Model\Discount\Discount;
use Shapin\Stripe\Model\Invoice\Invoice;
use Shapin\Stripe\Model\Invoice\LineItem as InvoiceItem;
use Shapin\Stripe\Model\Plan\Plan;
use Shapin\Stripe\Model\Product\Product;
use Shapin\Stripe\Model\Refund\Refund;
use Shapin\Stripe\Model\Source\Source;
use Shapin\Stripe\Model\Subscription\Subscription;
use Shapin\Stripe\Model\Transfer\Transfer;

trait EventTrait
{
    use LivemodeTrait;
    use MetadataTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $apiVersion;

    /**
     * @var \DateTimeImmutable
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $pendingWebhooks;

    /**
     * @var ?Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var ?Account
     */
    private $account;

    /**
     * @var ?Balance
     */
    private $balance;

    /**
     * @var ?BankAccount
     */
    private $bankAccount;

    /**
     * @var ?Card
     */
    private $card;

    /**
     * @var ?Charge
     */
    private $charge;

    /**
     * @var ?Coupon
     */
    private $coupon;

    /**
     * @var ?Customer
     */
    private $customer;

    /**
     * @var ?Discount
     */
    private $discount;

    /**
     * @var ?Invoice
     */
    private $invoice;

    /**
     * @var ?InvoiceItem
     */
    private $invoiceItem;

    /**
     * @var ?Plan
     */
    protected $plan;

    /**
     * @var ?Product
     */
    protected $product;

    /**
     * @var ?Refund
     */
    protected $refund;

    /**
     * @var ?Source
     */
    protected $source;

    /**
     * @var ?Subscription
     */
    private $subscription;

    /**
     * @var ?Transfer
     */
    private $transfer;

    /**
     * @var array
     */
    private $previousAttributes;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->apiVersion = $data['api_version'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->live = (bool) $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata'] ?? []);
        $model->pendingWebhooks = (int) $data['pending_webhooks'];
        $model->request = isset($data['request']) ? Request::createFromArray($data['request']) : null;
        $model->type = $data['type'];
        $model->previousAttributes = $data['data']['previous_attributes'] ?? [];

        if ('invoice.upcoming' === $data['type']) {
            return $model;
        }

        $object = $data['data']['object']['object'];
        switch ($object) {
            case 'account':
                $model->account = Account::createFromArray($data['data']['object']);
                break;
            case 'balance':
                $model->balance = Balance::createFromArray($data['data']['object']);
                break;
            case 'bank_account':
                $model->bankAccount = BankAccount::createFromArray($data['data']['object']);
                break;
            case 'card':
                $model->card = Card::createFromArray($data['data']['object']);
                break;
            case 'charge':
                $model->charge = Charge::createFromArray($data['data']['object']);
                break;
            case 'coupon':
                $model->coupon = Coupon::createFromArray($data['data']['object']);
                break;
            case 'customer':
                $model->customer = Customer::createFromArray($data['data']['object']);
                break;
            case 'discount':
                $model->discount = Discount::createFromArray($data['data']['object']);
                break;
            case 'invoice':
                $model->invoice = Invoice::createFromArray($data['data']['object']);
                break;
            case 'invoiceitem':
                $model->invoiceItem = InvoiceItem::createFromArray($data['data']['object']);
                break;
            case 'plan':
                $model->plan = Plan::createFromArray($data['data']['object']);
                break;
            case 'product':
                $model->product = Product::createFromArray($data['data']['object']);
                break;
            case 'refund':
                $model->refund = Refund::createFromArray($data['data']['object']);
                break;
            case 'source':
                $model->source = Source::createFromArray($data['data']['object']);
                break;
            case 'subscription':
                $model->subscription = Subscription::createFromArray($data['data']['object']);
                break;
            case 'transfer':
                $model->transfer = Transfer::createFromArray($data['data']['object']);
                break;
            default:
                throw new InvalidArgumentException("Unable to process event data: Unknown object $object");
        }

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPendingWebhooks(): int
    {
        return $this->pendingWebhooks;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
