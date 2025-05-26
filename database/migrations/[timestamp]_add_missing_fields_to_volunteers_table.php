public function up()
{
    Schema::table('volunteers', function (Blueprint $table) {
        $table->string('phone')->after('email');
        $table->text('motivation')->after('phone');
        $table->date('availability_date')->after('motivation');
    });
}

public function down()
{
    Schema::table('volunteers', function (Blueprint $table) {
        $table->dropColumn(['phone', 'motivation', 'availability_date']);
    });
}