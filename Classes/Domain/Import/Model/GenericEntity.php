<?php

declare(strict_types=1);

/*
 * Copyright (C) 2021 Daniel Siepmann <coding@daniel-siepmann.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301, USA.
 */

namespace WerkraumMedia\ThueCat\Domain\Import\Model;

class GenericEntity implements Entity
{
    /**
     * @var int
     */
    private $typo3StoragePid;

    /**
     * @var string
     */
    private $typo3DatabaseTableName;

    /**
     * @var int
     */
    private $typo3SystemLanguageUid;

    /**
     * @var bool
     */
    private $created = false;

    /**
     * @var int
     */
    private $typo3Uid = 0;

    /**
     * @var string
     */
    private $remoteId;

    /**
     * @var mixed[]
     */
    private $data;

    public function __construct(
        int $typo3StoragePid,
        string $typo3DatabaseTableName,
        int $typo3SystemLanguageUid,
        string $remoteId,
        array $data
    ) {
        $this->typo3StoragePid = $typo3StoragePid;
        $this->typo3DatabaseTableName = $typo3DatabaseTableName;
        $this->typo3SystemLanguageUid = $typo3SystemLanguageUid;
        $this->remoteId = $remoteId;
        $this->data = $data;
    }

    public function getTypo3StoragePid(): int
    {
        return $this->typo3StoragePid;
    }

    public function getTypo3DatabaseTableName(): string
    {
        return $this->typo3DatabaseTableName;
    }

    public function getTypo3SystemLanguageUid(): int
    {
        return $this->typo3SystemLanguageUid;
    }

    public function isForDefaultLanguage(): bool
    {
        return $this->getTypo3SystemLanguageUid() === 0;
    }

    public function isTranslation(): bool
    {
        return $this->getTypo3SystemLanguageUid() !== 0;
    }

    public function getRemoteId(): string
    {
        return $this->remoteId;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setImportedTypo3Uid(int $uid): void
    {
        $this->typo3Uid = $uid;
        $this->created = true;
    }

    public function setExistingTypo3Uid(int $uid): void
    {
        $this->typo3Uid = $uid;
        $this->created = false;
    }

    public function getTypo3Uid(): int
    {
        return $this->typo3Uid;
    }

    public function exists(): bool
    {
        return $this->getTypo3Uid() !== 0;
    }

    public function wasCreated(): bool
    {
        return $this->created;
    }
}
