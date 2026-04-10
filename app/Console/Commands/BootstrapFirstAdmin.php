<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Silber\Bouncer\BouncerFacade as Bouncer;

#[Signature('app:bootstrap-first-admin {email? : Existing user email to promote}')]
#[Description('Create or promote the first admin user')]
class BootstrapFirstAdmin extends Command
{
    public function handle(): int
    {
        $email = $this->argument('email');

        if (is_string($email) && $email !== '') {
            return $this->promoteExistingUser($email);
        }

        return $this->createFirstAdmin();
    }

    protected function createFirstAdmin(): int
    {
        $user = User::query()->first();

        if ($user === null) {
            $this->components->error('No users exist yet. Create a user first, then promote it with the email argument.');

            return self::FAILURE;
        }

        $this->ensureAdminRoleExists();

        if ($user->isAn('admin')) {
            $this->components->info("The first user, {$user->email}, is already an admin.");

            return self::SUCCESS;
        }

        $user->assign('admin');
        Bouncer::refreshFor($user);

        $this->components->info("Promoted {$user->email} to admin.");

        return self::SUCCESS;
    }

    protected function promoteExistingUser(string $email): int
    {
        $user = User::query()->where('email', $email)->first();

        if ($user === null) {
            $this->components->error("No user was found for {$email}.");

            return self::FAILURE;
        }

        $this->ensureAdminRoleExists();

        if ($user->isAn('admin')) {
            $this->components->info("{$user->email} is already an admin.");

            return self::SUCCESS;
        }

        $user->assign('admin');
        Bouncer::refreshFor($user);

        $this->components->info("Promoted {$user->email} to admin.");

        return self::SUCCESS;
    }

    protected function ensureAdminRoleExists(): void
    {
        Bouncer::role()->firstOrCreate([
            'name' => 'admin',
        ]);
    }
}
