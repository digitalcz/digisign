# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Common Commands

### Testing and Quality Assurance
- `composer tests` - Run PHPUnit tests
- `composer phpstan` - Run PHPStan static analysis
- `composer cs` - Run PHP CodeSniffer for code style checks
- `composer csfix` - Fix code style issues automatically with PHP Code Beautifier and Fixer
- `composer checks` - Run all quality checks (cs, phpstan, tests)

### Development Workflow
After making changes, always run `composer checks` to ensure code quality standards are met.

## Architecture Overview

### Core Components
The DigiSign SDK is a PHP library that provides communication with the DigiSign API using PSR-18 HTTP Client, PSR-17 HTTP Factories, and PSR-16 SimpleCache.

#### Main Classes
- **DigiSign** (src/DigiSign.php) - Main entry point and service container
- **DigiSignClient** (src/DigiSignClient.php) - HTTP client wrapper with PSR standard implementations
- **ResourceEndpoint** (src/Endpoint/ResourceEndpoint.php) - Abstract base class for API endpoints
- **BaseResource** (src/Resource/BaseResource.php) - Base class for API response resources

#### Authentication
- **ApiKeyCredentials** - API key-based authentication
- **TokenCredentials** - Token-based authentication  
- **CachedCredentials** - Decorator for caching credentials

#### Endpoint Pattern
All API endpoints extend ResourceEndpoint and use traits for common CRUD operations:
- `CRUDEndpointTrait` - Full CRUD operations
- `CreateEndpointTrait` - Create operations
- `GetEndpointTrait` - Get operations
- `ListEndpointTrait` - List operations
- `UpdateEndpointTrait` - Update operations
- `DeleteEndpointTrait` - Delete operations

#### Resource System
- Resources are automatically hydrated from API responses
- Support for nested resources and collections
- Type mapping through PHP DocBlocks for complex types
- Dynamic property access for API fields not explicitly defined

### Key Features
- **Webhook Signature Validation** - Built-in signature validation for webhook security
- **File Upload Support** - Handles file uploads via multipart streams
- **Testing/Production API** - Configurable API base URLs
- **PSR Compliance** - Uses PSR-18 (HTTP Client), PSR-17 (HTTP Factories), PSR-16 (SimpleCache)
- **Exception Handling** - Comprehensive exception hierarchy for different HTTP error codes

### Code Conventions
- PHP 8.0+ with strict typing (`declare(strict_types=1)`)
- Uses phpdoc for type hints, especially for collections and complex types
- Follows PSR-12 coding standards
- Extensive use of final classes and protected methods
- Template-based type annotations for generic collections

### Testing Structure
- Unit tests mirror the src/ directory structure
- Uses PHPUnit with extensive mocking
- Separate test classes for each endpoint and resource
- Test utilities in tests/bootstrap.php