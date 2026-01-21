use Illuminate\Support\Facades\Hash;

$password = 'admin123';
$hashedPassword = Hash::make($password);

echo $hashedPassword;
