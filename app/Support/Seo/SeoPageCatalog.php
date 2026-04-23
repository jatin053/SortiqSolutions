<?php

namespace App\Support\Seo;

class SeoPageCatalog
{
    public static function pages(): array
    {
        return [
            self::page(
                section: 'Company Pages',
                label: 'Home',
                routeName: 'frontend.home',
                title: 'Sortiq Solutions | Web Development, Apps & Digital Marketing',
                description: 'Sortiq Solutions provides web development, mobile app development, digital marketing, and IT services to help businesses grow with reliable digital solutions.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'About',
                routeName: 'frontend.about',
                title: 'About Sortiq Solutions | Web, App & Digital Experts',
                description: 'Learn about Sortiq Solutions, our mission, expertise, and client-focused approach to web development, software, and digital growth services.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Why Us',
                routeName: 'frontend.why-us',
                title: 'Why Choose Sortiq Solutions | Web & App Development Partner',
                description: 'Learn why businesses choose Sortiq Solutions for web development, app development, digital marketing, and reliable long-term support.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Expertise',
                routeName: 'frontend.expertise',
                title: 'Our Expertise | Web, Apps, Design & Digital Solutions',
                description: 'Discover Sortiq Solutions expertise in web development, digital marketing, mobile apps, design, and scalable IT solutions for modern businesses.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Case Studies',
                routeName: 'frontend.cases',
                title: 'Case Studies | Sortiq Solutions Project Results',
                description: 'Explore Sortiq Solutions case studies to see how our web, app, and digital solutions solve business challenges and support long-term growth.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Careers',
                routeName: 'frontend.careers',
                title: 'Careers at Sortiq Solutions | Join Our Digital Team',
                description: 'Explore career opportunities at Sortiq Solutions and join our team building websites, software, apps, and digital experiences for growing businesses.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Internship',
                routeName: 'frontend.internship',
                title: 'Internship Opportunities in Chandigarh Mohali | Sortiq Solutions',
                description: 'Start your career with internship opportunities at Sortiq Solutions in Chandigarh Mohali and gain practical experience in digital and IT work.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'FAQ',
                routeName: 'frontend.faq',
                title: 'FAQ | Sortiq Solutions Services & Support',
                description: 'Find answers to common questions about Sortiq Solutions services, project workflows, support, and digital delivery process.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Support',
                routeName: 'frontend.support',
                title: 'Support | Sortiq Solutions Help & Assistance',
                description: 'Get support from Sortiq Solutions for website, software, and digital service questions, updates, and ongoing assistance.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Terms',
                routeName: 'frontend.terms',
                title: 'Terms & Service Policies | Sortiq Solutions',
                description: 'Read the terms and service policies for using Sortiq Solutions websites, support, and digital services.'
            ),
            self::page(
                section: 'Company Pages',
                label: 'Contact',
                routeName: 'frontend.contact',
                title: 'Contact Sortiq Solutions | Start Your Digital Project',
                description: 'Contact Sortiq Solutions for web development, mobile apps, digital marketing, and IT support tailored to your business goals.'
            ),

            self::page(
                section: 'Content Pages',
                label: 'Blog',
                routeName: 'frontend.blog.index',
                title: 'IT, Web Design & Digital Marketing Blog | Sortiq Solutions',
                description: 'Read the latest Sortiq Solutions blog posts on web design, development, digital marketing, and practical IT insights for growing businesses.'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Portfolio',
                routeName: 'frontend.portfolio',
                title: 'Portfolio | Web Design & Development Work by Sortiq Solutions',
                description: 'Explore Sortiq Solutions portfolio of web design, development, branding, and digital projects built for growing businesses.'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Reviews',
                routeName: 'frontend.reviews',
                title: 'Client Reviews & Testimonials | Sortiq Solutions',
                description: 'Read client reviews and testimonials for Sortiq Solutions and see how our digital services support real business growth.'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Clients',
                routeName: 'frontend.clients',
                title: 'Trusted Clients & Partners | Sortiq Solutions',
                description: 'Explore the trusted client network of Sortiq Solutions and see the brands that rely on our web, software, and digital services.'
            ),
            self::page(
                section: 'Content Pages',
                label: 'Videos',
                routeName: 'frontend.videos',
                title: 'Videos & IT Insights | Sortiq Solutions',
                description: 'Watch Sortiq Solutions videos on web development, digital marketing, design, and business-focused IT insights.'
            ),

            self::page(
                section: 'Service Pages',
                label: 'Services Overview',
                routeName: 'frontend.services.index',
                title: 'Services | Web Development, Apps, Design & Digital Marketing',
                description: 'Explore Sortiq Solutions services in web development, app development, digital marketing, design, CRM, and scalable IT solutions.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Web Development',
                routeName: 'frontend.services.web',
                title: 'Website Development Company in Chandigarh | Sortiq Solutions',
                description: 'Website development services from Sortiq Solutions for custom, responsive, and business-focused websites that perform.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Website Design',
                routeName: 'frontend.services.design',
                title: 'Website Designing Company in Chandigarh | Sortiq Solutions',
                description: 'Website designing services from Sortiq Solutions that combine modern UI, strong branding, and user-focused conversion journeys.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Laravel',
                routeName: 'frontend.services.laravel',
                title: 'Laravel Development Company in Chandigarh | Sortiq Solutions',
                description: 'Laravel development services from Sortiq Solutions for secure, scalable, and custom web applications built for growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'WordPress',
                routeName: 'frontend.services.wordpress',
                title: 'WordPress Development Company in Chandigarh | Sortiq Solutions',
                description: 'WordPress development services from Sortiq Solutions for flexible, scalable, and easy-to-manage business websites.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Ecommerce',
                routeName: 'frontend.services.ecommerce',
                title: 'Ecommerce Development Company in Chandigarh | Sortiq Solutions',
                description: 'E-commerce development services from Sortiq Solutions for custom online stores, better shopping experiences, and business growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Digital Marketing',
                routeName: 'frontend.services.marketing',
                title: 'Digital Marketing Company in Chandigarh | Sortiq Solutions',
                description: 'Digital marketing services from Sortiq Solutions to improve reach, lead generation, conversions, and long-term brand growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'SEO',
                routeName: 'frontend.services.seo',
                title: 'SEO Company in Chandigarh | Sortiq Solutions',
                description: 'SEO services from Sortiq Solutions to improve search visibility, rankings, organic traffic, and long-term digital growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'SMO',
                routeName: 'frontend.services.smo',
                title: 'SMO Services in Chandigarh | Sortiq Solutions',
                description: 'Social media optimization services from Sortiq Solutions to improve visibility, engagement, and brand reach across digital channels.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Graphics',
                routeName: 'frontend.services.graphics',
                title: 'Graphic Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Graphic designing services from Sortiq Solutions for brand visuals, marketing creatives, and digital assets that make an impact.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Banners',
                routeName: 'frontend.services.banners',
                title: 'Banner Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Get banner designing services from Sortiq Solutions for digital campaigns, websites, ads, and brand promotions that stand out.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Logos',
                routeName: 'frontend.services.logos',
                title: 'Logo Designing Services in Chandigarh | Sortiq Solutions',
                description: 'Logo designing services from Sortiq Solutions to create memorable brand identities for startups, businesses, and digital products.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Maintenance',
                routeName: 'frontend.services.maintenance',
                title: 'Website Maintenance Services in Chandigarh | Sortiq Solutions',
                description: 'Website maintenance services from Sortiq Solutions for updates, security, performance checks, and reliable ongoing support.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'BigCommerce',
                routeName: 'frontend.services.bigcommerce',
                title: 'BigCommerce Development Services | Sortiq Solutions',
                description: 'BigCommerce development services from Sortiq Solutions to build scalable e-commerce stores with better performance and conversions.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'MERN Stack',
                routeName: 'frontend.services.mern',
                title: 'MERN Stack Development Services | Sortiq Solutions',
                description: 'MERN stack development services from Sortiq Solutions for modern, high-performance web applications with scalable architecture.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'App Development',
                routeName: 'frontend.services.apps',
                title: 'Mobile App Development Services | Sortiq Solutions',
                description: 'Build custom mobile and app solutions with Sortiq Solutions to improve user experience, business efficiency, and digital growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Testing',
                routeName: 'frontend.services.testing',
                title: 'Software Testing Services in Chandigarh | Sortiq Solutions',
                description: 'Software testing services from Sortiq Solutions to improve quality, performance, reliability, and release confidence.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Cyber Security',
                routeName: 'frontend.services.security',
                title: 'Cyber Security Services | Sortiq Solutions',
                description: 'Cyber security services from Sortiq Solutions to help protect websites, applications, and business data from modern threats.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'HubSpot',
                routeName: 'frontend.services.hubspot',
                title: 'HubSpot CRM Services | Sortiq Solutions',
                description: 'HubSpot CRM services from Sortiq Solutions to improve lead management, automation, sales workflows, and customer communication.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Zoho',
                routeName: 'frontend.services.zoho',
                title: 'Zoho CRM Services in Chandigarh | Sortiq Solutions',
                description: 'Zoho CRM services from Sortiq Solutions to streamline sales, automation, customer tracking, and business workflows.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'PHP',
                routeName: 'frontend.services.php',
                title: 'PHP Development Services | Sortiq Solutions',
                description: 'PHP development services from Sortiq Solutions for custom websites, web apps, and reliable business platforms.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'CodeIgniter',
                routeName: 'frontend.services.codeigniter',
                title: 'CodeIgniter Development Services | Sortiq Solutions',
                description: 'CodeIgniter development services from Sortiq Solutions for fast, secure, and scalable web applications tailored to business needs.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Shopify',
                routeName: 'frontend.services.shopify',
                title: 'Shopify Development Services | Sortiq Solutions',
                description: 'Shopify development services from Sortiq Solutions for custom online stores, better conversions, and flexible e-commerce growth.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'React',
                routeName: 'frontend.services.react',
                title: 'React JS Development Services | Sortiq Solutions',
                description: 'React JS development services from Sortiq Solutions for interactive, responsive, and high-performance digital experiences.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Node',
                routeName: 'frontend.services.node',
                title: 'Node.js Development Services | Sortiq Solutions',
                description: 'Node.js development services from Sortiq Solutions for fast, scalable backend systems and web applications.'
            ),
            self::page(
                section: 'Service Pages',
                label: 'Vue',
                routeName: 'frontend.services.vue',
                title: 'Vue JS Development Services | Sortiq Solutions',
                description: 'Vue JS development services from Sortiq Solutions for modern interfaces, responsive apps, and scalable front-end experiences.'
            ),
        ];
    }

    public static function routeNames(): array
    {
        return array_column(self::pages(), 'route_name');
    }

    public static function defaultMetaMap(): array
    {
        $meta = [];

        foreach (self::pages() as $page) {
            $meta[$page['route_name']] = [
                'title' => $page['title'],
                'description' => $page['description'],
            ];
        }

        return $meta;
    }

    private static function page(
        string $section,
        string $label,
        string $routeName,
        string $title,
        string $description,
    ): array {
        return [
            'section' => $section,
            'label' => $label,
            'route_name' => $routeName,
            'title' => $title,
            'description' => $description,
        ];
    }
}
