# Iran Essential Data Repository

This repository contains essential data for Iranian geographic divisions, administrative codes, and other fundamental data required for Iranian-based applications. The data is provided in JSON format and is ready to use with database seeders.

## Contents

### Geographic Data
- **Provinces (استان‌ها)**
  - Complete list of Iranian provinces
  - Includes: name, postal code, geographical coordinates, zoom levels
  - 31 provinces covered

- **Cities (شهرها)**
  - Comprehensive list of Iranian cities
  - Includes: name, postal code, province relationship, geographical coordinates
  - City size classification (metropolitan, large, medium, small)
  - Proper zoom levels for map display

### Data Format

#### Province Structure
```json
{
    "id": "1",
    "name": "تهران",
    "postal_code": "00",
    "lat": "35.6892",
    "long": "51.3890",
    "zoom_level": "8"
}
```

#### City Structure
```json
{
    "name": "تهران",
    "postal_code": "1",
    "province_id": "1",
    "lat": "35.6892",
    "long": "51.3890",
    "size": "metropolitan",
    "zoom_level": "11"
}
```

## Usage

### Laravel Implementation

1. Copy the required JSON files to your project's seeder data directory:
```bash
cp iran-provinces-and-cities.json database/seeders/data/
```

2. Create necessary migrations:

```php
// provinces migration
Schema::create('provinces', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('postal_code');
    $table->decimal('lat', 10, 4);
    $table->decimal('long', 10, 4);
    $table->integer('zoom_level');
    $table->timestamps();
});

// cities migration
Schema::create('cities', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('postal_code');
    $table->foreignId('province_id')->constrained()->onDelete('cascade');
    $table->decimal('lat', 10, 4);
    $table->decimal('long', 10, 4);
    $table->enum('size', ['small', 'medium', 'large', 'metropolitan']);
    $table->integer('zoom_level');
    $table->timestamps();
});
```

3. Create and run the seeder:
```php
php artisan make:seeder IranProvincesCitiesSeeder
php artisan db:seed --class=IranProvincesCitiesSeeder
```

### Other Frameworks

The JSON data can be used with any framework or programming language. The data structure is framework-agnostic and can be easily adapted to different database schemas.

## Data Verification

All data has been verified against official Iranian government sources and geographical databases. The coordinates have been validated for accuracy and precision.

### City Size Classification

- **Metropolitan**: Population over 1,000,000
- **Large**: Population between 250,000 and 1,000,000
- **Medium**: Population between 50,000 and 250,000
- **Small**: Population under 50,000

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/UpdateData`)
3. Commit your changes (`git commit -m 'Add some data'`)
4. Push to the branch (`git push origin feature/UpdateData`)
5. Open a Pull Request

### Data Update Guidelines

When contributing new data or updates:
- Provide official sources for the data
- Maintain the existing JSON structure
- Include all required fields
- Verify geographical coordinates
- Test the data with the provided seeders

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Changelog

### Version 1.0.0
- Initial release
- Complete provinces and cities data
- Laravel seeder implementation
- Basic documentation

## Support

For support, please open an issue in the repository or contact the maintainers.

## Acknowledgments

- Iran National Geographical Organization
- Iran Post Company
- OpenStreetMap Contributors

---

**Note**: This data is maintained by the community and while we strive for accuracy, users should verify critical data against official government sources for their specific use cases.