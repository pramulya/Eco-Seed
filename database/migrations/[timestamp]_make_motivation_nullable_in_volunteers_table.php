public function up()
{
    Schema::table('volunteers', function (Blueprint $table) {
        $table->text('motivation')->nullable()->change();
    });
}

public function down()
{
    Schema::table('volunteers', function (Blueprint $table) {
        $table->text('motivation')->nullable(false)->change();
    });
}