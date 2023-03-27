<?php
/**
 * Create Collection
 *
 * @since     Mar 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Qdrant\Models\Request;

class CreateCollection implements RequestModel
{
    /**
     * @var VectorParams|VectorParams[]
     */
    protected array $vectors;
    protected ?int $shardNumber = null;
    protected ?int $replicationFactor = null;

    protected ?int $writeConsistencyFactor = null;

    protected ?bool $onDiskPayload = null;

    protected ?InitFrom $initFrom = null;

    public function addVector(VectorParams $vectorParams, string $name = null): CreateCollection
    {
        if ($name !== null) {
            $this->vectors[$name] = $vectorParams;
        } else {
            $this->vectors[] = $vectorParams;
        }

        return $this;
    }

    public function setShardNumber(int $shardNumber): CreateCollection
    {
        $this->shardNumber = $shardNumber;

        return $this;
    }

    public function setReplicationFactor(int $replicationFactor): CreateCollection
    {
        $this->replicationFactor = $replicationFactor;

        return $this;
    }

    public function setWriteConsistencyFactor(int $writeConsistencyFactor): CreateCollection
    {
        $this->writeConsistencyFactor = $writeConsistencyFactor;

        return $this;
    }

    public function setOnDiskPayload(bool $onDiskPayload): CreateCollection
    {
        $this->onDiskPayload = $onDiskPayload;

        return $this;
    }

    public function setInitFrom(InitFrom $initFrom): CreateCollection
    {
        $this->initFrom = $initFrom;

        return $this;
    }



    public function toArray(): array
    {
        $data = [];
        if ($this->vectors) {
            $data['vectors'] = [];
            foreach ($this->vectors as $name => $vector) {
                $data['vectors'][$name] = $vector->toArray();
            }
        }
        if ($this->shardNumber) {
            $data['shard_number'] = $this->shardNumber;
        }
        if ($this->replicationFactor) {
            $data['replication_factor'] = $this->replicationFactor;
        }
        if ($this->writeConsistencyFactor) {
            $data['write_consistency_factor'] = $this->writeConsistencyFactor;
        }
        if ($this->onDiskPayload) {
            $data['on_disk_payload'] = $this->onDiskPayload;
        }
        if ($this->initFrom !== null) {
            $data['init_from'] = $this->initFrom->toArray();
        }

        return $data;
    }
}