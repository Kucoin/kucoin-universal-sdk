// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

import { instanceToPlain, plainToInstance } from 'class-transformer';
import { Serializable } from '@internal/interfaces/serializable';

export class GetMarginRiskLimitData implements Serializable<GetMarginRiskLimitData> {
    /**
     * Time stamp
     */
    timestamp?: number;
    /**
     * CROSS MARGIN RESPONSES, Currency
     */
    currency?: string;
    /**
     * CROSS MARGIN RESPONSES, Maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     */
    borrowMaxAmount?: string;
    /**
     * CROSS MARGIN RESPONSES, Maximum buy amount
     */
    buyMaxAmount?: string;
    /**
     * CROSS MARGIN RESPONSES, Maximum holding amount
     */
    holdMaxAmount?: string;
    /**
     * CROSS MARGIN RESPONSES, [Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     */
    borrowCoefficient?: string;
    /**
     * CROSS MARGIN RESPONSES, [Margin Coefficient](https://www.kucoin.com/land/price-protect)
     */
    marginCoefficient?: string;
    /**
     * CROSS MARGIN RESPONSES, Currency precision. the minimum repayment amount of a single transaction should be >= currency precision, for example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     */
    precision?: number;
    /**
     * CROSS MARGIN RESPONSES, Minimum personal borrow amount
     */
    borrowMinAmount?: string;
    /**
     * CROSS MARGIN RESPONSES, Minimum unit for borrowing, the borrowed amount must be an integer multiple of this value
     */
    borrowMinUnit?: string;
    /**
     * CROSS MARGIN RESPONSES, Whether to support borrowing
     */
    borrowEnabled?: boolean;
    /**
     * ISOLATED MARGIN RESPONSES, Symbol
     */
    symbol?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     */
    baseMaxBorrowAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum personal borrow amount. If the platform has no borrowing amount, this value will still be displayed.
     */
    quoteMaxBorrowAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum buy amount
     */
    baseMaxBuyAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum buy amount
     */
    quoteMaxBuyAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base maximum holding amount
     */
    baseMaxHoldAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Quote maximum holding amount
     */
    quoteMaxHoldAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base currency precision. the minimum repayment amount of a single transaction should be >= currency precision, for example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     */
    basePrecision?: number;
    /**
     * ISOLATED MARGIN RESPONSES, Quote currency precision. the minimum repayment amount of a single transaction should be >= currency precision, for example, the precision of ETH is 8, and the minimum repayment amount is 0.00000001
     */
    quotePrecision?: number;
    /**
     * ISOLATED MARGIN RESPONSES, Base minimum personal borrow amount
     */
    baseBorrowMinAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Quote minimum personal borrow amount
     */
    quoteBorrowMinAmount?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base minimum unit for borrowing, the borrowed amount must be an integer multiple of this value
     */
    baseBorrowMinUnit?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Quote minimum unit for borrowing, the borrowed amount must be an integer multiple of this value
     */
    quoteBorrowMinUnit?: string;
    /**
     * ISOLATED MARGIN RESPONSES, Base whether to support borrowing
     */
    baseBorrowEnabled?: boolean;
    /**
     * ISOLATED MARGIN RESPONSES, Quote whether to support borrowing
     */
    quoteBorrowEnabled?: boolean;
    /**
     * ISOLATED MARGIN RESPONSES, [Base Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     */
    baseBorrowCoefficient?: string;
    /**
     * ISOLATED MARGIN RESPONSES, [Quote Borrow Coefficient](https://www.kucoin.com/land/price-protect)
     */
    quoteBorrowCoefficient?: string;
    /**
     * ISOLATED MARGIN RESPONSES, [Base Margin Coefficient](https://www.kucoin.com/land/price-protect)
     */
    baseMarginCoefficient?: string;
    /**
     * ISOLATED MARGIN RESPONSES, [Quote Margin Coefficient](https://www.kucoin.com/land/price-protect)
     */
    quoteMarginCoefficient?: string;

    fromJson(input: string): GetMarginRiskLimitData {
        const jsonObject = JSON.parse(input);
        return plainToInstance(GetMarginRiskLimitData, jsonObject);
    }

    toJson(): string {
        return JSON.stringify(instanceToPlain(this));
    }

    fromObject(jsonObject: Object): GetMarginRiskLimitData {
        return plainToInstance(GetMarginRiskLimitData, jsonObject);
    }
}