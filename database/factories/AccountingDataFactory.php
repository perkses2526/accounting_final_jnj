<?php

namespace Database\Factories;

use App\Models\AccountingData; // Ensure this points to the correct model
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountingData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Expanded Charts of Accounts
        $chartsOfAccounts = [
            'cash',
            'accounts_receivable',
            'accounts_payable',
            'inventory',
            'sales_revenue',
            'purchase_expenses',
            'tax_expenses',
            'bank_loans',
            'fixed_assets',
            'depreciation_expense',
            'prepaid_expenses',
            'rent_expense',
            'salary_expense',
            'interest_income',
            'utilities_expense',
            'insurance_expense',
            'equipment',
            'software',
            'goodwill',
            'accumulated_depreciation',
            'dividends_payable',
            'bonds_payable'
        ];

        // Class to Subclass Mappings
        $classToSubClassMapping = [
            'asset' => ['current_asset', 'long_term_asset', 'fixed_asset', 'intangible_asset'],
            'liability' => ['current_liability', 'long_term_liability'],
            'equity' => ['owner_equity', 'retained_earnings', 'accumulated_loss'],
            'revenue' => ['operating_revenue', 'non_operating_revenue'],
            'expense' => ['direct_expense', 'indirect_expense', 'administrative_expense', 'financial_expense']
        ];

        // Generate consistent company, division, and department combinations
        $companyData = [
            'COMP_ABC' => ['division' => 'DIV_ABC', 'department' => 'DEPT_ABC'],
            'COMP_XYZ' => ['division' => 'DIV_XYZ', 'department' => 'DEPT_XYZ'],
            'COMP_BCD' => ['division' => 'DIV_BCD', 'department' => 'DEPT_BCD']
        ];

        // Randomly select a company and get its corresponding division and department
        $companyCode = $this->faker->randomElement(array_keys($companyData));
        $divisionCode = $companyData[$companyCode]['division'];
        $departmentCode = $companyData[$companyCode]['department'];

        // Randomly select a class and get its relevant subclass
        $class = $this->faker->randomElement(array_keys($classToSubClassMapping));
        $subClass = $this->faker->randomElement($classToSubClassMapping[$class]);

        // Generate the date entered after January 1st of the current year and before today
        $dateEntered = $this->faker->dateTimeBetween('January 1st ' . now()->year, 'now');

        // Randomly decide if this entry will use debit or credit, but not both
        $isDebit = $this->faker->boolean;
        $amount = $this->faker->randomFloat(2, 0, 10000); // Generate a random amount

        return [
            'company_code' => $companyCode,
            'division_code' => $divisionCode,
            'department_code' => $departmentCode,
            'date_entered' => $dateEntered,
            'source' => $this->faker->numberBetween(1, 3), // Assuming there are 3 transaction lists
            'charts_of_accounts' => $this->faker->randomElement($chartsOfAccounts),
            'class' => $class,
            'sub_class' => $subClass,
            'debit' => $isDebit ? $amount : null, // Set amount to debit if isDebit is true
            'credit' => !$isDebit ? $amount : null, // Set amount to credit if isDebit is false
            'amount' => $amount, // Amount is the same as debit or credit
            'currency' => $this->faker->currencyCode(),
            'posting_month' => $this->faker->dateTimeBetween($dateEntered, 'December 31st ' . now()->year), // Posting date same as or after date_entered
            'remarks' => $this->faker->sentence(),
            'created_by' => $this->faker->randomNumber(5, true),
            'updated_by' => $this->faker->randomNumber(5, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
