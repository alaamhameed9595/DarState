<?php

namespace App\Http\Controllers;

use \App\Services;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        // Welcome with Messenger-style quick replies
        $botman->hears('^(start|menu|help|hi|hello|hey)$', function ($bot) {
            $question = Question::create("🏢 *Welcome to DarState!*\n\nI'm your professional real estate assistant. What would you like to know?")
                ->addButtons([
                    Button::create('🏢 About DarState')->value('about'),
                    Button::create('📞 Contact Info')->value('contact'),
                    Button::create('🛠️ Our Services')->value('services'),
                    Button::create('🕒 Office Hours')->value('hours'),
                    Button::create('🏠 View Properties')->value('properties'),
                ]);
            $bot->reply($question);
        });

        // Handle button clicks and text inputs
        $botman->hears('about', function ($bot) {
            $this->showAboutInfo($bot);
        });

        $botman->hears('contact', function ($bot) {
            $this->showContactInfo($bot);
        });

        $botman->hears('services', function ($bot) {
            $this->showServices($bot);
        });

        $botman->hears('hours', function ($bot) {
            $this->showOfficeHours($bot);
        });

        $botman->hears('properties', function ($bot) {
            $this->showProperties($bot);
        });

        // Handle individual property selections
        $botman->hears('property_(\d+)', function ($bot, $propertyId) {
            $this->showPropertyDetails($bot, $propertyId);
        });

        // Handle view all properties
        $botman->hears('view_all', function ($bot) {
            $this->showAllProperties($bot);
        });

        // Text-based triggers (for users who type instead of clicking)
        $botman->hears('(about|what is darstate|tell me about darstate)', function ($bot) {
            $this->showAboutInfo($bot);
        });

        $botman->hears('(contact|how to contact|phone|email|address)', function ($bot) {
            $this->showContactInfo($bot);
        });

        $botman->hears('(services|what services|offer|do you offer)', function ($bot) {
            $this->showServices($bot);
        });

        $botman->hears('(office hours|hours|working hours|when are you open)', function ($bot) {
            $this->showOfficeHours($bot);
        });

        $botman->hears('(properties|show me all properties|find all properties|get all properties)', function ($bot) {
            $this->showProperties($bot);
        });

        // Fallback
        $botman->fallback(function ($bot) {
            $question = Question::create("🤔 I didn't understand that. Here are some things you can ask me:")
                ->addButtons([
                    Button::create('🏢 About DarState')->value('about'),
                    Button::create('📞 Contact Info')->value('contact'),
                    Button::create('🛠️ Our Services')->value('services'),
                    Button::create('🕒 Office Hours')->value('hours'),
                    Button::create('🏠 View Properties')->value('properties'),
                ]);
            $bot->reply($question);
        });

        $botman->listen();
    }

    private function showAboutInfo($bot)
    {
        $message = "🏢 *About DarState*\n\n";
        $message .= "DarState is your trusted real estate partner in the UAE, specializing in:\n\n";
        $message .= "✅ *Residential Properties*\n";
        $message .= "• Apartments & Villas\n";
        $message .= "• Townhouses & Penthouses\n";
        $message .= "• New Developments\n\n";
        $message .= "✅ *Commercial Properties*\n";
        $message .= "• Office Spaces\n";
        $message .= "• Retail Units\n";
        $message .= "• Industrial Properties\n\n";
        $message .= "📍 *Location*: Mayah Str. no 8, b5, 56832, AlAin, UAE\n";
        $message .= "📞 *Phone*: +971 506074002\n";
        $message .= "📧 *Email*: contact@darstate.com";

        $question = Question::create($message)
            ->addButtons([
                Button::create('📞 Contact Us')->value('contact'),
                Button::create('🛠️ Our Services')->value('services'),
                Button::create('🏠 View Properties')->value('properties'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }

    private function showContactInfo($bot)
    {
        $message = "📞 *Contact Information*\n\n";
        $message .= "📍 *Address*: Mayah Str. no 8, b5, 56832, AlAin, UAE\n";
        $message .= "📱 *Phone*: +971 506074002\n";
        $message .= "📧 *Email*: contact@darstate.com\n";
        $message .= "🌐 *Telegram*: @DarStateCity\n\n";
        $message .= "_We're here to help!_";

        $question = Question::create($message)
            ->addButtons([
                Button::create('🕒 Office Hours')->value('hours'),
                Button::create('🏢 About Us')->value('about'),
                Button::create('🏠 View Properties')->value('properties'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }

    private function showServices($bot)
    {
        $message = "🛠️ *Our Services*\n\n";
        $message .= "🏠 *Property Services*\n";
        $message .= "• Property Buying & Selling\n";
        $message .= "• Property Rentals\n";
        $message .= "• Property Management\n";
        $message .= "• Property Valuation\n\n";
        $message .= "💼 *Consulting Services*\n";
        $message .= "• Investment Advisory\n";
        $message .= "• Market Analysis\n";
        $message .= "• Legal Consultation\n";
        $message .= "• Financing Support\n\n";
        $message .= "📋 *Additional Services*\n";
        $message .= "• Property Photography\n";
        $message .= "• Virtual Tours\n";
        $message .= "• Property Insurance\n";
        $message .= "• Maintenance Services";

        $question = Question::create($message)
            ->addButtons([
                Button::create('🏠 View Properties')->value('properties'),
                Button::create('📞 Contact Us')->value('contact'),
                Button::create('🏢 About Us')->value('about'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }

    private function showOfficeHours($bot)
    {
        $message = "🕒 *Office Hours*\n\n";
        $message .= "📅 *Monday - Friday*: 09 AM - 19 PM\n";
        $message .= "📅 *Saturday*: 09 AM - 14 PM\n";
        $message .= "📅 *Sunday*: Closed\n\n";
        $message .= "⏰ *Best Times to Visit*\n";
        $message .= "• Weekdays: 10 AM - 6 PM (peak hours)\n";
        $message .= "• Saturday: 10 AM - 1 PM\n\n";
        $message .= "📞 *After Hours Support*\n";
        $message .= "For urgent inquiries outside office hours, you can:\n";
        $message .= "• Leave a message on our website\n";
        $message .= "• Send us an email\n";
        $message .= "• Contact us on Telegram";

        $question = Question::create($message)
            ->addButtons([
                Button::create('📞 Contact Us')->value('contact'),
                Button::create('🏠 View Properties')->value('properties'),
                Button::create('🛠️ Our Services')->value('services'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }

    private function showProperties($bot)
    {
        $properties = \App\Models\Property::limit(5)->get();

        if ($properties->isEmpty()) {
            $message = "🔍 *No properties available at the moment.*\n\nPlease check back later or contact us directly.";

            $question = Question::create($message)
                ->addButtons([
                    Button::create('📞 Contact Us')->value('contact'),
                    Button::create('🛠️ Our Services')->value('services'),
                    Button::create('🏢 About Us')->value('about'),
                    Button::create('🔄 Main Menu')->value('menu'),
                ]);
            $bot->reply($question);
            return;
        }

        $message = "🏠 *Featured Properties*\n\n";
        $message .= "📋 *Showing " . $properties->count() . " properties*\n\n";

        $propertyButtons = [];

        foreach ($properties as $index => $property) {
            $propertyNumber = $index + 1;
            $message .= "🏠 *Property #{$propertyNumber}*\n";
            $message .= "📍 *{$property->title}*\n";
            $message .= "💰 *Price*: AED " . number_format($property->price) . "\n";
            $message .= "🏠 *Type*: {$property->type}\n";
            $message .= "📍 *Location*: {$property->location}\n";
            $message .= "📏 *Size*: {$property->size} sq ft\n";
            $message .= "🛏️ *Bedrooms*: {$property->bedrooms}\n";
            $message .= "🚿 *Bathrooms*: {$property->bathrooms}\n";
            $message .= "🔗 [View Details](" . route('website.property', $property->id) . ")\n\n";

            // Add button for each property
            $propertyButtons[] = Button::create("🏠 Property #{$propertyNumber}")->value("property_{$property->id}");
        }

        $message .= "💡 *Tip*: Click on any property button above to get more details, or visit our website to see all properties!";

        // Add navigation buttons
        $allButtons = array_merge($propertyButtons, [
            Button::create('🌐 View All Properties')->value('view_all'),
            Button::create('📞 Contact Agent')->value('contact'),
            Button::create('🔄 Main Menu')->value('menu'),
        ]);

        $question = Question::create($message)->addButtons($allButtons);
        $bot->reply($question);
    }

    private function showPropertyDetails($bot, $propertyId)
    {
        $property = \App\Models\Property::find($propertyId);

        if (!$property) {
            $message = "❌ *Property not found.*\n\nThe property you're looking for doesn't exist or has been removed.";

            $question = Question::create($message)
                ->addButtons([
                    Button::create('🏠 View Properties')->value('properties'),
                    Button::create('📞 Contact Us')->value('contact'),
                    Button::create('🔄 Main Menu')->value('menu'),
                ]);
            $bot->reply($question);
            return;
        }

        $message = "🏠 *Property Details*\n\n";
        $message .= "📍 *{$property->title}*\n\n";
        $message .= "💰 *Price*: AED " . number_format($property->price) . "\n";
        $message .= "🏠 *Type*: {$property->type}\n";
        $message .= "📍 *Location*: {$property->location}\n";
        $message .= "📏 *Size*: {$property->size} sq ft\n";
        $message .= "🛏️ *Bedrooms*: {$property->bedrooms}\n";
        $message .= "🚿 *Bathrooms*: {$property->bathrooms}\n";
        $message .= "🚗 *Parking*: {$property->parking}\n";
        $message .= "🏊 *Amenities*: {$property->amenities}\n\n";
        $message .= "📝 *Description*:\n{$property->description}\n\n";
        $message .= "🔗 [View Full Details](" . route('website.property', $property->id) . ")\n";
        $message .= "📞 [Contact Agent](" . route('website.contact') . ")\n\n";
        $message .= "💡 *Interested in this property? Contact us for a viewing!*";

        $question = Question::create($message)
            ->addButtons([
                Button::create('📞 Contact Agent')->value('contact'),
                Button::create('🏠 View All Properties')->value('properties'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }

    private function showAllProperties($bot)
    {
        $message = "🌐 *All Properties*\n\n";
        $message .= "Visit our website to browse all available properties with advanced search and filtering options!\n\n";
        $message .= "🔗 [Browse All Properties](" . route('website.properties') . ")\n\n";
        $message .= "📱 *Website Features:*\n";
        $message .= "• Advanced search filters\n";
        $message .= "• Property comparisons\n";
        $message .= "• Virtual tours\n";
        $message .= "• High-quality photos\n";
        $message .= "• Contact forms\n";
        $message .= "• Location maps\n\n";
        $message .= "💡 *Need help finding the perfect property? Our agents are here to assist you!*";

        $question = Question::create($message)
            ->addButtons([
                Button::create('📞 Contact Agent')->value('contact'),
                Button::create('🏠 Featured Properties')->value('properties'),
                Button::create('🛠️ Our Services')->value('services'),
                Button::create('🔄 Main Menu')->value('menu'),
            ]);
        $bot->reply($question);
    }
}
