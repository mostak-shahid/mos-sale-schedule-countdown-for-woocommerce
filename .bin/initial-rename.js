const replace = require('replace-in-file');
const glob = require('glob');
const path = require('path');
const fs = require('fs');
const { promisify } = require('util');
const renameAsync = promisify(fs.rename);

const filePath = path.join(process.cwd(), '**/*.{css,scss,js,php}');

const files = glob.sync(filePath, {
    ignore: ['**/node_modules/**'],
});

const options = {
    files: files,
    from: [
        /plugin-starter/g,
        /plugin_starter/g,
        /plugin starter/g,
        /PLUGIN-STARTER/g,
        /PLUGIN_STARTER/g,
        /PLUGIN STARTER/g,
        /Plugin-Starter/g,
        /Plugin_Starter/g,
        /Plugin Starter/g,
        /PluginStarter/g,
        /Plugin starter/g
    ],
    to: [
        'mos-sale-schedule-countdown-for-woocommerce',
        'mos_sale_schedule_countdown_for_woocommerce',
        'mos sale schedule countdown for woocommerce',
        'MOS-SALE-SCHEDULE-COUNTDOWN-FOR-WOOCOMMERCE',
        'MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE',
        'MOS SALE SCHEDULE COUNTDOWN FOR WOOCOMMERCE',
        'Mos-Sale-Schedule-Countdown-For-Woocommerce',
        'Mos_Sale_Schedule_Countdown_For_Woocommerce',
        'Mos Sale Schedule Countdown For Woocommerce',
        'MosSaleScheduleCountdownForWoocommerce',
        'Mos sale schedule countdown for woocommerce',
    ],
    verbose: true,
    dry: false,
};

const renamedResults = [];
async function renamePHPFiles() {
    const renamePromises = files
        .filter((file) => file.endsWith('.php'))
        .filter((file) => /plugin-starter/.test(file))
        .map(async (file) => {
            const dir = path.dirname(file);
            const baseName = path.basename(file);
            const newBaseName = baseName.replace(
                /plugin-starter/gi,
                'mos-sale-schedule-countdown-for-woocommerce'
            );
            const newFileName = path.join(dir, newBaseName);

            try {
                const baseNameOriginalFile = path.basename(file);
                const baseNameNewFile = path.basename(newFileName);
                if (baseNameOriginalFile !== baseNameNewFile) {
                    await renameAsync(file, newFileName);
                    renamedResults.push({
                        from: file,
                        to: newFileName,
                    });
                }
            } catch (error) {
                console.error(`Error renaming ${file}:`, error);
            }
        });

    await Promise.all(renamePromises);
}

async function main() {
    try {
        const results = await replace(options);
        console.log('Replacement results:', results);
        await renamePHPFiles();
        console.log('');
        console.log('File renamed results:', renamedResults);

    } catch (error) {
        console.error('Error occurred:', error);
    }
}

main();
